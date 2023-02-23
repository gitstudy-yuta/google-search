$(function(){
    $(".send_page").on("click", function(){
        var searchParams = new URLSearchParams();
        var pageIndex = ($(this).attr("data-index"));
        var searchKey = $("input[name='searchKey']").val();
        searchParams.append("searchKey", searchKey);
        searchParams.append("index", pageIndex);
        window.location.href = searchUrl + "?" + searchParams.toString();
    });
});