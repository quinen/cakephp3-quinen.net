<?php
$this->append('header',$this->cell('QuinenBootstrap4.Menu')->render());
?>
<?= $this->Html->docType(); ?>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',[
        'integrity' => "sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm",
        'crossorigin'=>"anonymous"
    ]); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>


    <?= $this->Flash->render() ?>

    <?php
        echo $this->Html->div(
            'container-fluid',
            $this->fetch('header').
            $this->fetch('content').
            $this->fetch('footer')
        );
    ?>

    <!--    jquery  -->
    <?= $this->Html->script("https://code.jquery.com/jquery-3.2.1.slim.min.js",[
        'integrity' => "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN",
        'crossorigin'=>"anonymous"
    ]) ?>
    <!--    popper  -->
    <?= $this->Html->script("https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js",[
        'integrity' => "sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q",
        'crossorigin'=>"anonymous"
    ]) ?>
    <!--    bootstrap  -->
    <?= $this->Html->script("https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js",[
        'integrity' => "sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl",
        'crossorigin'=>"anonymous"
    ]) ?>

    <!--    font awesome 5 -->
    <?= $this->Html->script("https://use.fontawesome.com/releases/v5.0.10/js/solid.js",[
        'integrity' => "sha384-Q7KAHqDd5trmfsv85beYZBsUmw0lsreFBQZfsEhzUtUn5HhpjVzwY0Aq4z8DY9sA",
        'crossorigin'=>"anonymous",
        'defer' => true
    ]) ?>
    <?= $this->Html->script("https://use.fontawesome.com/releases/v5.0.10/js/fontawesome.js",[
        'integrity' => "sha384-M2FSA4xMm1G9m4CNXM49UcDHeWcDZNucAlz1WVHxohug0Uw1K+IpUhp/Wjg0y6qG",
        'crossorigin'=>"anonymous",
        'defer' => true
    ]) ?>
</body>
</html>
