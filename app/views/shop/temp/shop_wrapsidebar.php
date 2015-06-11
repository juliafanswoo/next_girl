<div class="wrapSidebar">
	<h2><?if($wrap_name_Str === 'product'):?>購物<?elseif($wrap_name_Str === 'showpiece'):?>租賃<?endif?>搜尋</h2>
	<div class="wrapSidebox">
        <script>
        $(function(){
            $(document).on('change', '.selectMajor > select', function(){
                // $this = $(this);
                var select_data = $(this).val();
                $('.selectSecond').css('display', 'none');
                $('.selectSecond[data-selectSecondValue=' + select_data + ']').css('display', 'block');
            });
            $(document).on('change', '.selectSecond > select', function(){
                location.href = "<?if($wrap_name_Str === 'product'):?>shop/?classid=<?elseif($wrap_name_Str === 'showpiece'):?>showpiece/?classid=<?endif?>" + $(this).val();
            });
        });
        </script>
        <div class="selectMajor">
            <select>
                <option value="">選擇主要分類</option>
                <?foreach($class2_ClassMetaList->obj_Arr as $key2 => $value2_ClassMeta):?>
                 <option value="<?=$value2_ClassMeta->classid_Num?>"<?if(!empty($search_class_ClassMeta->class_ClassMetaList->obj_Arr[0]->classid_Num) && $search_class_ClassMeta->class_ClassMetaList->obj_Arr[0]->classid_Num === $value2_ClassMeta->classid_Num):?> selected<?endif?>><?=$value2_ClassMeta->classname_Str?></option>
                <?endforeach?>
            </select>
        </div>
        <?foreach($class2_ClassMetaList->obj_Arr as $key2 => $value2_ClassMeta):?>
        <div class="selectSecond" data-selectSecondValue="<?=$value2_ClassMeta->classid_Num?>"<?if(!empty($search_class_ClassMeta->class_ClassMetaList->obj_Arr[0]->classid_Num) && $search_class_ClassMeta->class_ClassMetaList->obj_Arr[0]->classid_Num === $value2_ClassMeta->classid_Num):?><?else:?> style="display:none;"<?endif?>>
            <select>
                <option value="">請選擇子分類</option>
                <?
                if($wrap_name_Str === 'product')
                {
                    $test_ClassMetaList = new ObjList();
                    $test_ClassMetaList->construct_db(array(
                        'db_where_Arr' => array(
                            'modelname_Str' => 'product_shop'
                        ),
                        'db_where_or_Arr' => array(
                            'classids' => array($value2_ClassMeta->classid_Num)
                        ),
                        'model_name_Str' => 'ClassMeta',
                        'limitstart_Num' => 0,
                        'limitcount_Num' => 100
                    ));
                }
                else if($wrap_name_Str === 'showpiece')
                {
                    $test_ClassMetaList = new ObjList();
                    $test_ClassMetaList->construct_db(array(
                        'db_where_Arr' => array(
                            'modelname_Str' => 'showpiece'
                        ),
                        'db_where_or_Arr' => array(
                            'classids' => array($value2_ClassMeta->classid_Num)
                        ),
                        'model_name_Str' => 'ClassMeta',
                        'limitstart_Num' => 0,
                        'limitcount_Num' => 100
                    ));
                }

	            ?>
            	<?foreach($test_ClassMetaList->obj_Arr as $key3 => $value3_ClassMeta):?>
            		<option value="<?=$value3_ClassMeta->classid_Num?>"<?if($classid_Num === $value3_ClassMeta->classid_Num):?> selected<?endif?>><?=$value3_ClassMeta->classname_Str?></option>
            	<?endforeach?>
        	</select>
        </div>
    	<?endforeach?>
	</div>
</div>