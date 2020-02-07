
 $(document).ready(function() {
//   var currentItem = 1;
//   $('#addnew').click(function(){
//    currentItem++;
//    $('#items').val(currentItem);
// var strToAdd = '<tr><td>Year</td><td>:</td><td><select name="year'+currentItem+'" id="year'+currentItem+'" ><option value="2012">2012</option><option value="2011">2011</option></select></td><td>Month</td><td>:</td><td width="17%"><select name="month'+currentItem+'" id="month'+currentItem+'"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select></td><td width="7%">Week</td><td width="3%">:</td><td width="17%"><select name="week'+currentItem+'" id="week'+currentItem+'" ><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td><td width="8%">&nbsp;</td><td colspan="2">&nbsp;</td></tr><tr><td>Actual</td><td>:</td><td width="17%"><input name="actual'+currentItem+'" id="actual'+currentItem+'" type="text" /></td><td width="7%">Max</td> <td width="3%">:</td><td><input name="max'+currentItem+'" id ="max'+currentItem+'"type="text" /></td><td>Target</td><td>:</td><td><input name="target'+currentItem+'" id="target'+currentItem+'" type="text" /></td></tr>';
//    $('#data').append(strToAdd);
   
//   });
 });

var URL = window.location.host;

var  nearbyCount = $('#nearby_count').val();
var  nearbyRunningNo = 0;

$("button.btn-add-product-detail").live('click', function() {

    var nearbyRunningNo = 0;
    var count = $("#nearby_count").val() - 0;

    $("#nearby_count").val(++count);
    nearbyCount++;

    var $tr = $("#nearby_table tbody tr:first");
    var $clone = $tr.html();
    
    var $form="<tr>"+$clone+"</tr>";  

    $('#nearby_table tbody tr:last').after($form);

}); 


$("button.btn-remove-product-detail").live('click',function(){
    if(nearbyCount==0){
        alert("There must be at least one item!");
        return false;
    }

	$(this).closest('tr').remove();

    nearbyCount--;

	var count = $("#nearby_count").val() - 0;
	$("#nearby_count").val(--count);
	
});


$("button.btn-add-product-detail-edit").live('click', function() {

    var nearbyRunningNo = 0;
    var count = $("#nearby_count").val() - 0;

    $("#nearby_count").val(++count);
    nearbyCount++;

    var $tr = $("#nearby_table tbody tr:first");
    var $clone = $tr.html();
    var $form = $("<tr>" + $clone + "</tr>");
    $form.find(":input").val("");
    
    $('#nearby_table tbody tr:last').after($form);

}); 


$("button.btn-remove-product-detail-edit").live('click',function(){
    
    if(nearbyCount==1){
        alert("There must be at least one item!");
        return false;
    }

    // var parentRow = $(this).closest('tr');

    // // //delete using ajax
    // $.get('/product/detail/destroy/'+ $(this).closest('tr').find('#product_detail_id').val(), 
    // function(data, status, xhr){       

    //     parentRow.remove();
        
    //     productDetailCount--;

    //     var count = $("#product_detail_count").val() - 0;
    //     $("#product_detail_count").val(--count);

    // });    

    $(this).closest('tr').remove();
    nearbyCount--;
    var count = $("#nearby_count").val() - 0;
    $("#nearby_count").val(--count);
});



var  productGalleryCount = $('#gallery_count').val();

var  productGalleryRunningNo = 0;

$("button.btn-add-product-gallery").live('click', function() {

    var productGalleryRunningNo = 0;
    var count = $("#product_gallery_count").val() - 0;

    $("#product_gallery_count").val(++count);
    productGalleryCount++;

    var $tr = $("#product_gallery_table tbody tr:first");
    var $clone = $tr.html();

    var $form=$("<tr>"+$clone+"</tr>");
    $form.find("img").attr("src","");
    $('#product_gallery_table tbody tr:last').after($form);

});

$("button.btn-remove-product-gallery").live('click',function(){

    console.log(productGalleryCount);

    if(productGalleryCount==0){
        alert("There must be at least one item!");
        return false;
    }

    $(this).closest('tr').remove();
    productGalleryCount--;

    var count = $("#product_gallery_count").val() - 0;
    $("#product_gallery_count").val(--count);

});

$("button.btn-add-product-gallery-edit").live('click', function() {

    var productGalleryRunningNo = 0;
    var count = $("#product_gallery_count").val() - 0;

    $("#product_gallery_count").val(++count);
    productGalleryCount++;

    var $tr = $("#product_gallery_table tbody tr:first");
    var $clone = $tr.html();

    var $form=$("<tr>"+$clone+"</tr>");
    $form.find("img").attr("src","");
    $form.find(":input").val("");
    $('#product_gallery_table tbody tr:last').after($form);

});

//image gallery remove
$("button.btn-remove-product-gallery-edit").live('click',function(){

    var parentRow = $(this).closest('tr');
    var row  = $(this).closest('tr').find('#product_gallery_id').val();

    if(productGalleryCount==1){
        alert("There must be at least one image!");
        return false;
    }

    if(row){

        window.location ="/admin/product/gallery/destroy/"+ row;

    }else{
        $(this).closest('tr').remove();
        productGalleryCount--;
        var count = $("#product_gallery_count").val() - 0;
        $("#product_gallery_count").val(--count);
    }
    // //delete using ajax
    // $.get('/product/gallery/destroy/'+ $(this).closest('tr').find('#product_gallery_id').val(), {

    // }, function(data, status, xhr){

    //     alert(data);
    //     console.log(xhr);

    //     parentRow.remove();
    //     productGalleryCount--;

    //     var count = $("#product_gallery_count").val() - 0;
    //     $("#product_gallery_count").val(--count);

    // });

   
});