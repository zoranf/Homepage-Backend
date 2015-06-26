<form id="formId" action="<?= site_url("AdminAsset/upload"); ?>" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="text" name="title">
    <input type="file" name="picture" id="picture">
    <button type="submit" name="submit" id="submitAd">Submit</button>
</form>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
    $(document).ready(function(){
        $("#formId").submit(function(e){
            e.preventDefault();
            var data = new FormData($("#formId")[0]);

            // append some data to request
            // data.append("id", 9);

            $.ajax({
                // url: "http://eko.dev:8080/AdminAsset/edit",
                url: "http://eko.dev:8080/AdminAsset/post",
                data: data,//new FormData($("#formId")[0]),
                processData: false,
                contentType: false, 
                type: "POST",
                xhr: function() {  // Custom XMLHttpRequest
                    // w000t ta stvar dela!
                    var myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){ // Check if upload property exists
                        myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
                    }
                    return myXhr;
                },
                success: function (result) {
                    // console.log(result);
                }
            });
        });
        function progressHandlingFunction(e){
            if(e.lengthComputable){
                // $('progress').attr({value:e.loaded,max:e.total});
                console.log(e.loaded);
                console.log(e.total);
            }
        }
    });
</script>
