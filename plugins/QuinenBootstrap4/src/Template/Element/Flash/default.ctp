<?php
$context = (isset($context)?$context:"info");
$isDismissible = (isset($isDismissible)?$isDismissible:true);

if($isDismissible){
    $context .= " alert-dismissible fade show";
    $message .= $this->Form->button(
        $this->Html->tag(
            'span', 
            "&times;",
            [
                'aria-hidden' => "true"
            ]
        ),
        [
            'type' => "button",
            'class' => "close",
            'data-dismiss' => "alert",
            'aria-label' => "Close"
        ]
    );
}

echo $this->Html->div(
    'alert alert-' . $context,
    $message
);