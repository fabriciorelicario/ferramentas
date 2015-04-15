jQuery(function($){
    
//    $('.fileupload-exists, #output, #tools, #progress').hide();
    $('.fileupload-exists').hide();
    $preview = $('#preview-pane'),
    $pcnt = $('#preview-pane .preview-container'),
    $pimg = $('#preview-pane .preview-container img'),
    
    xsize = $pcnt.width(),
    ysize = $pcnt.height();
    
    var dimension = "";
    
//    window.onbeforeunload = function() {
//        var response = confirm("Prefere realizar esta tarefa uma outra hora?");
//        if(response == true){
//            alert('saindo da pagina');
//        }else{
//            return false;
//        }
//    }
    
    
    $('#adminForm').submit(function(event){
        event.preventDefault();
        if($('#image').val() === ""){
            Following.renderMessages({"message":"É necessário selecionar uma foto do computador","type":"warning"},'#system-messages');
            return false;
        }else{
            this.submit();
        }
        
    });
    
    $('[type=file]').change(function(){
        if($('.radio input').is(':checked') === false){
            Following.renderMessages({"message":"É necessário selecionar uma dimensão para ajustar o novo redimensionamento","type":"warning"},'#system-messages');
            return false;
        }else{
            var dimension = $('.radio input:checked').val();
            var splited = $('.radio input:checked').val().split('X');
            var options = {
                    dataType: "json",
                    cache:false,
                    target: '#output',
                    data: {dimension:dimension},
                    beforeSend: function() {
                        $('#input, #progress').show();
                        $('.progress-bar').width('0%').attr('aria-valuenow', '0%');
                        $('#output, #system-message-container').hide();
                    },
                    uploadProgress: function(event, position, total, percent) {
                        $('.progress-bar').width(percent + '%').attr('aria-valuenow', percent);
                    },
                    success: function(response) {
                        if(response.messages){
                            Following.renderMessageList(response.messages,'#row');
                            $('.progress-bar').width('0%').attr('aria-valuenow', '0%');
                            $('#progress').hide();
                            return false;
                        }

                        $('#input, #progress').hide();
                        $('.progress-bar').width('0%').attr('aria-valuenow', '0%');
                        $('#output').css({'display':'inline-block','width':splited[0],'height':splited[1]}).attr({'dataw':splited[0],'datah':splited[1]}).html(response.image);


                        $('#width').val(response.width);
                        $('#height').val(response.height);
                        $('#tmp_image').val(response.name);

                        $('.fileupload-new').hide();
                        $('.fileupload-exists').show();
                    },
                    error: function (request, status, error) {
                        Following.renderMessages({"message":request.status+' '+error,"type":"error"},'#system-messages');
                    }
            };

            $('#photoForm').ajaxForm(options);
            $('#photoForm').submit();
        }
    });
    
    $('#remove').click(function(){
        $('#output img, .jcrop-holder').remove();
        $('.fileupload-exists').hide();
        $('.fileupload-new, #input').show();
        $('#photoForm').resetForm();
        $('#x, #y, #w, #h, #width, #height, #tmp_image').val('');
    });
    
    $('#dimension').click(function(){
        $('#tools').css('display', 'inline-block');
        $('#output img').Jcrop({
            bgOpacity: 0.5,
            bgColor: 'white',
            addClass: 'jcrop-light',
            aspectRatio: 0,
            onChange: updatePreview,
            onSelect: updateCoords
        },function(){
            var bounds = this.getBounds();
            boundx = bounds[0];
            boundy = bounds[1];
            jcrop_api = this;
        });
    });
  
    function updateCoords(c){
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    };
    
    function updatePreview(c){
        if (parseInt(c.w) > 0){
            var rx = xsize / c.w;
            var ry = ysize / c.h;

            $pimg.css({
              width: Math.round(rx * boundx) + 'px',
              height: Math.round(ry * boundy) + 'px',
              marginLeft: '-' + Math.round(rx * c.x) + 'px',
              marginTop: '-' + Math.round(ry * c.y) + 'px'
            });
        }
    };
    
    $('#release').click(function(e) {
        jcrop_api.release();
        $('#x, #y, #w, #h').val('');
    });

    $('#slideshow-site').click(function(e) {
        jcrop_api.animateTo([625,384, 0,0]);
    });
    $('#slideshow-intranet').click(function(e) {
        jcrop_api.animateTo([426, 300,0,0]);
    });
});
//    
//    // Define page sections
//    var sections = {
//      bgc_buttons: 'Alterar Cor do Fundo',
//      bgo_buttons: 'Nível de Transparência',
//    };
//    
//    // Define bgOpacity buttons
//    var bgo = {
//      Baixo: .2,
//      Médio: .5,
//      Alto: .8,
//      Cheio: 1
//    };
//    
//    // Define bgColor buttons
//    var bgc = {
//      R: '#900',
//      B: '#4BB6F0',
//      Y: '#F0B207',
//      G: '#46B81C',
//      W: 'white',
//      K: 'black'
//    };
//    
//    // Create fieldset targets for buttons
//    for(i in sections)
//      insertSection(i,sections[i]);
//
//    function create_btn(c) {
//      var $o = $('<button />').addClass('btn btn-default');
//      if (c) $o.append(c);
//      return $o;
//    }
//    
//    // Create bgOpacity buttons
//    for(i in bgo) {
//      $('#bgo_buttons .btn-group').append(
//        create_btn(i).click(setoptHandler('bgOpacity',bgo[i])),
//        ' '
//      );
//    }
//    // Create bgColor buttons
//    for(i in bgc) {
//      $('#bgc_buttons .btn-group').append(
//        create_btn(i).css({
//          background: bgc[i],
//          color: ((i == 'K') || (i == 'R'))?'white':'black'
//        }).click(setoptHandler('bgColor',bgc[i])), ' '
//      );
//    }
//    // Function to insert named sections into interface
//    function insertSection(k,v) {
//      $('#tools').prepend(
//        $('<fieldset></fieldset>').attr('id',k).append(
//          $('<legend></legend>').append(v),
//          '<div class="btn-toolbar"><div class="btn-group btn-group-sm"></div></div>'
//        )
//      );
//    };
//    // Handler for option-setting buttons
//    function setoptHandler(k,v) {
//      return function(e) {
//        $(e.target).closest('.btn-group').find('.active').removeClass('active');
//        $(e.target).addClass('active');
//        var opt = { };
//        opt[k] = v;
//        jcrop_api.setOptions(opt);
//        return false;
//      };
//    };
//    // Handler for animation buttons
//    function animHandler(v) {
//      return function(e) {
//        $(e.target).addClass('active');
//        jcrop_api.animateTo(v,function(){
//          $(e.target).closest('.btn-group').find('.active').removeClass('active');
//        });
//        return false;
//      };
//    };