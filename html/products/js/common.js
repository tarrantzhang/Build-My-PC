$(function(){
	//单独选择某一个
	$("input[name='check_item']").click(function(){
			var index=$("input[name='check_item']").index(this);
			$("input[name='check_item']").eq(index).toggleClass("checked");//伪复选
	});	
	//全选
	$("#check_all,#box_all").click(function(){
     $("input[name='check_item']").attr("checked",$(this).attr("checked"));
	 $("input[name='check_item'],#check_all,#box_all").toggleClass("checked");
	});

});