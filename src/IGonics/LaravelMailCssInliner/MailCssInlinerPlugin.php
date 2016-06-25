<?php

namespace IGonics\LaravelMailCssInliner;

class MailCssInlinerPlugin implements \Swift_Events_SendListener
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @param array $options options defined in the configuration file.
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * @param Swift_Events_SendEvent $evt
     */
    public function beforeSendPerformed(\Swift_Events_SendEvent $evt)
    {
        $message = $evt->getMessage();

        if ($message->getContentType() === 'text/html' ||
            ($message->getContentType() === 'multipart/alternative' && $message->getBody()) ||
            ($message->getContentType() === 'multipart/mixed' && $message->getBody())
        ) {
            $message->setBody($this->renderContents($message->getBody()));
        }

        foreach ($message->getChildren() as $part) {
            if (strpos($part->getContentType(), 'text/html') === 0) {
                $part->setBody($this->renderContents($part->getBody()));
            }
        }
    }

    protected function renderContents($html, $css = '')
    {
        $emogrifier = new \Pelago\Emogrifier();
        $emogrifier->setHtml($html);
        $emogrifier->setCss($css);

        return $emogrifier->emogrify(true);
    }

    /**
     * Do nothing.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function sendPerformed(\Swift_Events_SendEvent $evt)
    {
        // Do Nothing
    }
}
