<?if(!empty($global['style'])):?>
    <?foreach($global['style'] as $value):?>
        <link rel="stylesheet" type="text/css" href="app/css/<?=$value?>.css"></link>
    <?endforeach?>
<?endif?>
</head>
<body>
    <div class="body">
        <div class="header">
            <a href="" class="logo"></a>
            <div class="logStatus">
                <span class="username"><?=$user['email']?></span>
                <a href="user/logout">登出</a>
            </div>
        </div>
        <div class="wrap">
            <div class="sidebar">
                <?foreach($admin_sidebox as $key => $child1):?>
                <div class="sidebox<?if(!empty($child1['select']) && $child1['select'] === TRUE):?> hover<?endif?>">
                    <h2><?=$child1['title']?></h2>
                    <?if(!empty($child1['child2'])):?>
                    <?foreach($child1['child2'] as $key2 => $child2):?>
                    <div class="acHref<?if(!empty($child2['select']) && $child2['select'] === TRUE):?> select hover<?endif?><?if(!empty($child2['display']) && $child2['display'] === TRUE):?> hidden<?endif?>">
                        <div class="acHrefBig">
                            <?=$child2['title']?>
                        </div>
                        <div class="acHrefSmallBar">
                        <?if(!empty($child2['child3'])):?>
                        <?foreach($child2['child3'] as $key3 => $child3):?>
                            <?if(!empty($child3['child4'])):?>
                            <?foreach($child3['child4'] as $key4 => $child4):?>
                                <a href="admin/<?=$key?>/<?=$key2?>/<?=$key3?>/<?=$key4?>" class="acHrefSmall<?if(!empty($child4['select'])):?> select hover<?endif?><?if(!empty($child4['display'])):?> hidden<?endif?>">
                                    <?=$child3['title']?> > <?=$child4['title']?>
                                </a>
                            <?endforeach?>
                            <?endif?>
                        <?endforeach?>
                        <?endif?>
                        </div>
                    </div>
                    <?endforeach?>
                    <?endif?>
                </div>
                <?endforeach?>
            </div>
            <div class="content">