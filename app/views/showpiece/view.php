<?=$temp['header_up']?>
<script src="app/js/cycle2.js"></script>
<script>
    $(function(){
        $(".productPicView").cycle({
            speed: 600,
            manualSpeed: 100,
            slides: '> .productPicViewLi2',
            pager: '.cycle-pager'
        });
    });
</script>
<?=$temp['header_down']?>
<?=$temp['topheader']?>
<?=$temp['shop_wrapsidebar']?>
<div class="wrapContent">
        <div class="wrapContentCenter">
            <div class="productBg">
                <div class="productTopBox">
                    <div class="productTopRightText">
                        <h2 class="productTopTitle"><?=$ShowPiece->name_Str?></h2>
                        <div class="priceLi">
                            <b class="price"> NT$ <?=$ShowPiece->price_Num?></b>
                        </div>
                        <p class="text">
                            <span class="textContent"><?=$ShowPiece->synopsis_Str?></span>
                        </p>
                    </div>
                    <div class="productPicView">
                        <div class="productPicViewLi2">
                            <?if(!empty($ShowPiece->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
                                <img src="<?=$ShowPiece->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
                            <?endif?>
                        </div>
                        <?if(!empty($ShowPiece->pic_PicObjList->obj_Arr)):?>
                        <?foreach($ShowPiece->pic_PicObjList->obj_Arr as $key => $value_PicObj):?>
                        <div class="productPicViewLi2">
                            <img src="<?=!empty($value_PicObj->path_Arr['w600h600'])?$value_PicObj->path_Arr['w600h600']:''?>">
                        </div>
                        <?endforeach?>
                        <?endif?>
                    </div>
                    <div class="cycle-pager"></div>
                </div>
                <div class="productContentTitle">
                </div>
                <div class="productArea displayblock">
                    <h2 class="borderTitle">產品規格</h2>
                    <div class="stage">
                        <?=$ShowPiece->content_specification_Html?>
                        <a href="" fanswoo-hrefNone class="top">top</a>
                    </div>
                    <h2 class="borderTitle">產品介紹</h2>
                    <div class="stage">
                        <?=$ShowPiece->content_Html?>
                        <a href="" fanswoo-hrefNone class="top">top</a>
                    </div>
                </div>
            </div>
        </div>
    <?=$temp['footer']?>