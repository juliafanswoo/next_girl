<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['topheader']?>
<div class="newsContant">
	<div class="content">
	   <h1>NEWS</h1>
	</div> 
	<div class="contentArea">
		<div class="leftBar">
			<h3>分類</h3>
			<div class="box">
				<?foreach($ClassMetaList->obj_Arr as $key => $value_ClassMeta):?>
				<a href="news/?class_slug=<?=$value_ClassMeta->slug_Str?>" class="li"><?=$value_ClassMeta->classname_Str?><img src="app/img/arrow.png" class="arrow">
				</a>
				<?endforeach?>
			</div>
		</div>
		<div class="stageBox">
			<?if(!empty($new_NoteFieldList->obj_Arr)):?>
			<?foreach($new_NoteFieldList->obj_Arr as $key => $value_NoteField):?>
			<div class="stage">
				<h2><a href="news/view/?noteid=<?=$value_NoteField->noteid_Num?>"><?=$value_NoteField->title_Str?></a></h2>	
				<p><?=mb_substr(strip_tags($value_NoteField->content_Html), 0, 150, 'utf-8')?></p>
				<a href="news/view/?noteid=<?=$value_NoteField->noteid_Num?>"class="more">
					more
				</a>
			</div>
			<?endforeach?>
			<div class="pageLink"><?=$page_link?></div>
			<?else:?>
			<p>這個分類沒有最新訊息</p>
			<?endif?>
		</div>		
	</div>		
	
<?=$temp['footer']?>