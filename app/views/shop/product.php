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
                        <?=form_open('order/add_cart')?>
                        <h2 class="productTopTitle"><?=$product_ProductShop->name_Str?></h2>
                        <div class="priceLi">
                            <b class="price">NT$ <?=$product_ProductShop->price_Num?></b>
                        </div>
                        <p class="text">
                            <span class="textContent"><?=$product_ProductShop->synopsis_Str?></span>
                        </p>
                        <?if(0):?>
                        <div class="selectBox">
                            <select>
                                <?if(!empty($product_ProductShop->class_ClassMetaList->obj_Arr)):?>
                                <?foreach($product_ProductShop->class_ClassMetaList->obj_Arr as $key => $value_ClassMeta):?>
                                <option value="<?=$value_ClassMeta->classid_Num?>"><?=$value_ClassMeta->classname_Str?></option>
                                <?endforeach?>
                                <?endif?>
                            </select>
                        </div>
                        <?endif?>
                        <input type="submit" id="checkoutAddProductSubmit" name="checkoutAddProductSubmit">
                        <span class="amount">
                            購買數量
                            <input type="number" name="amount_Num" min="1" max="99" value="1">
                        </span>
                        <input type="hidden" name="productid_Num" value="<?=$product_ProductShop->productid_Num?>">
                        </form>
                    </div>
                    <div class="productPicView">
                        <div class="productPicViewLi2">
                            <?if(!empty($product_ProductShop->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
                                <img src="<?=$product_ProductShop->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
                            <?endif?>
                        </div>
                        <?if(!empty($product_ProductShop->pic_PicObjList->obj_Arr)):?>
                        <?foreach($product_ProductShop->pic_PicObjList->obj_Arr as $key => $value_PicObj):?>
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
                        <?=$product_ProductShop->content_specification_Html?>
                        <a href="" fanswoo-hrefNone class="top">top</a>
                    </div>
                    <h2 class="borderTitle">產品介紹</h2>
                    <div class="stage">
                        <?=$product_ProductShop->content_Html?>
                        <a href="" fanswoo-hrefNone class="top">top</a>
                    </div>
                </div>
            </div>
        </div>
    <?=$temp['footer']?>