var FileURLs = {};
var constantURLs = {};

function UploadFile (icon , targetObj , defFile = null ){

    var closeFileInput = $(icon).parent().parent().find(".d-none");
    var inputName      = $(closeFileInput).attr('name');
    var hiddenInput    = $('input[name="' + inputName + '_physical_name'+'"]');
    var hiddenTitle    = $('input[name="' + inputName + '_title_physical_name'+'"]');
    var hiddenInpExist = ( hiddenInput.length > 0 );
    var hasFile        = true ;
    var uploadFile     = defFile;

    if( defFile == null ) {
        uploadFile      = $(closeFileInput).prop("files") ;
        hasFile         = ( uploadFile && uploadFile.length > 0  ) ;
        uploadFile      = uploadFile[0];
    }

    var fileTitle       = uploadFile.name

    console.log("fileList to upload : " , uploadFile);

    if( hasFile == false )return ;

    var progressCont   = $(icon).parent().parent().find(".progress-container");
    $(progressCont).show();

    var formData = new FormData();
    formData.append('file', uploadFile, uploadFile.name);
    formData.append('target_obj', targetObj);

    if( hiddenInpExist == true ){
        formData.append('prev_file',$(hiddenInput).val());
    }

    $(closeFileInput).val(null);

    toggleCancelSpinerOption(closeFileInput);

    $.ajax({
        xhr: function() {
            var xhr = new window.XMLHttpRequest();

            xhr.upload.addEventListener("progress", function (event) {
                progressAction(event , progressCont)
            }, false);

            xhr.addEventListener("load", function (event) {
                completeAction(event , progressCont)
            }, false);

            xhr.addEventListener("abort", function (event) {
                abortAction(event , progressCont)
            }, false);

            return xhr;
        },
        type: 'POST',
        url: ( envStatus != "development" ? SubDomain : "") +  '/api/file/upload',
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
            $(progressCont).find(".progress-bar").width('0%');
        },
        error:function(){
            $(progressCont).find(".progress-bar").width('100%');
            $(progressCont).find(".progress-bar-text").text("File uploading failed, please try again.")
            toggleCancelSpinerOption(closeFileInput);
        },
        success: function(response){
            toggleCancelSpinerOption(closeFileInput);

            if( response.meta.success == true ){
                $(closeFileInput).parent().find(".file-uploaded-upload-option").hide();

                if(hiddenInpExist == true){
                    $(hiddenInput).attr('value' , response.data.file_name)
                    $(hiddenTitle).attr('value' , fileTitle)
                }else {
                    hiddenInput = $("<input>", {
                        type:'hidden',
                        name: inputName + '_physical_name',
                        value : response.data.file_name
                    });

                    hiddenTitle = $("<input>", {
                        type:'hidden',
                        name: inputName + '_title_physical_name',
                        value : fileTitle
                    });
                    let closestForm = $(closeFileInput).closest("form")
                    $(closestForm).append(hiddenInput);
                    $(closestForm).append(hiddenTitle);
                }
            }else {
                $(progressCont).find(".progress-bar").width('100%');
                $(progressCont).find(".progress-bar-text").text(response.meta.message)
            }
        }
    });
}

function toggleCancelSpinerOption(input) {

    $(input).parent().find(".file-uploaded-cancel-option").toggle();
    $(input).parent().find(".file-uploaded-progress-animated-loader").toggle();
    if($('#upload_btn').prop('disabled') == true){
        $("#upload_btn").prop('disabled', false);
    }else {
        $("#upload_btn").prop('disabled', true);
    }

}

function deleteFile(icon,targetObj , deleteContainer = false , afterDelete = null ) {

    var FileInput      = $(icon).parent().parent().find(".d-none");
    var FileText       = $(icon).parent().parent().find(".file-uploaded-input");
    var inputName      = $(FileInput).attr('name')
    var hiddenInput    = $('input[name="' + inputName + '_physical_name'+'"]')
    var hiddenTitle    = $('input[name="' + inputName + '_title_physical_name'+'"]');
    var hiddenInpExist = ( hiddenInput.length > 0 )
    var text           = null;
    var progressCont   = $(icon).parent().parent().find(".progress-container");

    console.log(constantURLs ,inputName)

    if( constantURLs[inputName] != undefined ){
        text = getBaseName(constantURLs[inputName]);
    }

    if(deleteContainer == true){

        totalFile = $(FileInput).parent().parent().parent().find(".file-uploaded-input");
        $(totalFile).val(getPrevTotal($(totalFile).val() ,$(FileInput),$(FileInput).parent().parent()) )
        $(FileInput).parent().remove();

    }

    if( afterDelete != null ){
        afterDelete();
    }

    if( hiddenInpExist == false){
        hideUploadOptions(FileText);
        $(FileText).val(text);
        return;
    }

    var formData = new FormData();

    formData.append('target_obj', targetObj);
    formData.append('target_file',$(hiddenInput).val());

    $.ajax({
        type: 'POST',
        url: ( envStatus != "development" ? SubDomain : "") +  '/api/file/delete',
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        error:function(){
            window.scrollTo(0, 0);
            $('#failed_alert').val('<h3 style="color:#EA4335;">File deleting failed, please try again.</h3>')
            $('#failed_alert').toggle();
            $('#failed_alert').fadeIn(function(){
                $(this).fadeOut(4000)
            });
        },
        success: function(response){

            if( response.meta.success == true ){
                $(hiddenInput).remove();
                $(hiddenTitle).remove();
                hideUploadOptions(FileText);
                $(FileText).val(text);
                $(progressCont).hide();

            }else {
                window.scrollTo(0, 0);
                $('#failed_alert').val('<h3 style="color:#EA4335;">'+response.meta.message+'</h3>')
                $('#failed_alert').toggle();
                $('#failed_alert').fadeIn(function(){
                    $(this).fadeOut(4000)
                });
            }
        }
    });
}


function getPrevTotal(value , currentDeleted , containerOfBrotherFiles) {
    let firstSpace  =  value.indexOf(" ");
    let currentName =  $(currentDeleted).attr('name');
    let lastNum     = currentName.substring(currentName.lastIndexOf('_')+1);
    lastNum         = Number.parseInt(lastNum)
    currentName     = currentName.substring(0,currentName.lastIndexOf('_')+1);
    while (true){
        lastNum ++ ;
        // console.log("selector : " ,".uploaded-episode-container #"+currentName+lastNum)
        let Nextbrother = $(containerOfBrotherFiles).find(".uploaded-episode-container #"+currentName+lastNum)
        if(Nextbrother.length > 0 ){
            // console.log("Find it .... ")
            $(Nextbrother).attr('id' ,currentName + (lastNum-1) )
            $(Nextbrother).attr('name' ,currentName + (lastNum-1) )
            // console.log("Hidden Selector : " ,"input[name="+currentName+lastNum+"_physical_name")
            let hiddenUpload = $("input[name="+currentName+lastNum+"_physical_name");
            let hiddenTitle  = $("input[name="+currentName+lastNum+"_title_physical_name");

            if(hiddenUpload.length > 0 ){
                // console.log("HIDDEN -> Find it .... ")
                $(hiddenUpload).attr('name' ,currentName+(lastNum-1)+"_physical_name" )
                $(hiddenTitle).attr('name' ,currentName+(lastNum-1)+"_title_physical_name" )
            }
        }else {
            break;
        }
    }

    if( firstSpace > 0  ){
        let num = value.substring(0,firstSpace);
        num     = Number.parseInt(num)
        num -- ;
        return num + value.substring(firstSpace);
    }
    return value;
}

function progressAction(event ,progressCont) {
    var progBar = $(progressCont).find(".progress-bar")
    var progTxt = $(progressCont).find(".progress-bar-text")

    if (event.lengthComputable) {
        let percentComplete = Math.floor((event.loaded / event.total) * 100);
        $(progBar).width(percentComplete + '%');
        let loadedBytes =  getClosestUnit(event.loaded)
        loadedBytes = loadedBytes['value'] + loadedBytes['unit'];
        let totalBytes =  getClosestUnit(event.total)
        totalBytes = totalBytes['value'] + totalBytes['unit'];
        $(progTxt).text(percentComplete+'% ' + " ( " + loadedBytes+ " / " + totalBytes + " )" )
    }
}

function completeAction(event,progressCont) {
    var progBar = $(progressCont).find(".progress-bar")
    var progTxt = $(progressCont).find(".progress-bar-text")

    $(progBar).width('100%');
    $(progTxt).text("File uploading done successfully ...")
}


function abortAction(event) {
    var progBar = $(progressCont).find(".progress-bar")
    var progTxt = $(progressCont).find(".progress-bar-text")

    $(progBar).width('100%');
    $(progTxt).text("File uploading aborted, please try again.")
}

function getClosestUnit(bytes){
    let res = Number.parseInt(bytes) ;
    let postfix = "B";
    if( (res / 1024) > 1 ){
         res /= 1024 ;
        postfix = "KB";
        if( (res / 1024) > 1 ){
            res /= 1024 ;
            postfix = "MB";
            if( (res / 1024) > 1 ){
                res /= 1024 ;
                postfix = "GB";
            }
        }
    }
    return {
        'value' : Math.round(res) ,
        'unit'  : postfix
    }
}

function getBaseName(str) {
    tmp_str = str ;
    return tmp_str.substring(str.lastIndexOf("/")+1)
}

function readURL(input , afterRead )  {

    console.log("Enter With " , input  )
    if (input.files && input.files[0] ) {

        showUploadOptions(input);

        var extension = input.files[0].name.split(".").pop().toLowerCase();
        setFileName(input);
        var reader = new FileReader();

        reader.onload = function(event){
            FileURLs[$(input).attr('name')] = reader.result
            console.log("extension : " , extension)
            afterRead(reader.result, extension);
        }
        reader.readAsDataURL(input.files[0]);
    }

}

function showUploadOptions(input) {
    $(input).parent().find(".file-uploaded-upload-option").show();
    $(input).parent().find(".file-uploaded-cancel-option").show();
}

function hideUploadOptions(input) {
    $(input).parent().find(".file-uploaded-upload-option").hide();
    $(input).parent().find(".file-uploaded-cancel-option").hide();
}

function clickOnImageName(icon , afterClick) {
    afterClick(icon,FileURLs);
}

function setFileName(input , multi = false ) {
    var closeFileReview = $(input).parent().find('.file-uploaded-input');

    console.log("input.files[0] : ", input.files[0])
    console.log("closeFileReview : " , closeFileReview)

    let title = input.files.length + " files has been selected ..." ;

    if(multi == false){
        $(closeFileReview).val(input.files[0].name)
    }else {
        $(closeFileReview).val(title)
    }

}


function setFileInfo(input) {

    if(input.files && input.files[0]){

        showUploadOptions(input);
        var files = input.files;

        setFileName(input)

        var myVideo = files[0];
        var video = document.createElement('video');

        video.preload = 'metadata';
        video.onloadedmetadata = function() {

            window.URL.revokeObjectURL(video.src);
            var duration = video.duration;
            myVideo["duration"] = duration;

            console.log("Video : " , myVideo)
            console.log("duration : " ,duration)

            updateMovieDuration(myVideo);
        }
        video.src = URL.createObjectURL(files[0]);
    }
}


function updateMovieDuration(myVideo) {

    var duration = $('#duration');
    $(duration).attr("textContent" , "");

    console.log("Duration Elem : " , duration)

    var sec_num = parseInt(myVideo.duration, 10); // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}

    $(duration).attr("value" , hours+':'+minutes+':'+seconds);
}


function validationFile(el, typeFile , maxSize) {
    el.on('change', addFile);

    function addFile(event) {
        var reader = new FileReader();
        var readerBase64 = new FileReader();
        var file = event.target.files[0];
        reader.onloadend = function () {
            var realMimeType = getRealMimeType(reader);
            if (realMimeType !== 'unknown') {
                readerBase64.readAsDataURL(file);
                validSizeFile();
            } else {
                el.val('');
                // alert("Please upload a valid image file");
                $(".modal-body").html(`<p>
                        <b>Sorry!!</b> The Input File Format Is Incorrect <br>
                        Please Enter a Valid File That Belongs To The <span id='tfile' class='text-danger text-bold'></span> Files
                        </p>`);
                $("#tfile").text(typeFile);
                $("#validModal").modal('show');
            }
        };
        reader.readAsArrayBuffer(file);
    }

    function getRealMimeType(reader) {
        var arr = (new Uint8Array(reader.result)).subarray(0, 4);
        var header = '';
        var realMimeType;

        for (var i = 0; i < arr.length; i++) {
            header += arr[i].toString(16);
        }
        if (typeFile === "Images") {
            if (header === "89504e47") {
                realMimeType = "image/png";
            }
            else if (header === "47494638") {
                realMimeType = "image/gif";
            }
            else if (header === "ffd8ffDB" || header === "ffd8ffe0" || header === "ffd8ffe1" ||
                header === "ffd8ffe2" || header === "ffd8ffe3" || header === "ffd8ffe8") {
                realMimeType = "image/jpeg";
            }
            else if (header === "424d360") {
                realMimeType = "image/bmp";
            }
            else if (header === "49492a0") {
                realMimeType = "image/tif";
            }
            else if (header === "0010") {
                realMimeType = "image/ico"
            }
            else {
                realMimeType = "unknown";
            }
        }
        else if (typeFile === "Video") {
            if (header === "00018") {
                realMimeType = "video/mp4"
            }
            else if (header === "00020") {
                realMimeType = "video/mp4"
            }
            else {
                realMimeType = "unknown";
            }
        }
        else if (typeFile === "Subtitle") {
            if (header === "efbbbf31") {
                realMimeType = "Subtitle/srt";
            }
            else {
                realMimeType = "unknown";
            }
        }
        return realMimeType;
    }
    function validSizeFile() {
        var input = el, i, size=0,
            selectedFiles = input[0].files;
        for(i = 0 ;i < selectedFiles.length; i++ ) {
            if(typeof selectedFiles[i] !== 'undefined') {
                size += selectedFiles[i].size;
            }
        }
        if (size > maxSize) {
            input.val("");
            selectedFiles = null;
            $(".modal-body").html(`<p><b>Sorry!!</b> The Size Of The Input File Is Large<br>
                                        Please Choose a Smaller File From <span id='maxSize' class='text-danger text-bold'></span><p>`);
            $("#maxSize").text(maxSize+" btyes");
            $("#validModal").modal('show');
        }
    }
}
