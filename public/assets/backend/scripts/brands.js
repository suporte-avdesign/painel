 /**
 *     ___ _    __   ____            _
 *    /   | |  / /  / __ \___  _____(_)____ ____ 
 *   / /| | | / /  / / / / _ \/ ___/ / __ `/ __ \
 *  / ___ | |/ /  / /_/ /  __(__  ) / /_/ / / / /
 * /_/  |_|___/  /_____/\___/____/_/\__, /_/ /_/ 
 *                                 /____/        
 * ------------ By Anselmo Velame --------------- 
 *
 * Sistma Administrativo
 * Brands
 *
 */
;(function($, undefined)
{
    /**
     * Init table
     * @var array 
     */
    $.fn.loadTableBrands = function()
    {  
        var painel = Handlebars.compile($("#painel-"+tableBrand.id).html()),
        table = $("#"+tableBrand.id).DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: tableBrand.url,
                type: "POST",
                dataType: "json",
                headers: {'X-CSRF-TOKEN': tableBrand.token}
            },
            sScrollX: true,
            sScrollXInner: "100%",
            buttons: ['reset'],
            sPaginationType: "full_numbers",
            iDisplayLength: tableBrand.limit,
            sDom: 'CB<"clear"><"dataTables_header"lfr>t<"dataTables_footer"ip>',
            fnDrawCallback: function( oSettings ){
                if (!tableBrand.tableStyled){
                    $("#"+tableBrand.id).closest(".dataTables_wrapper").find(".dataTables_length select").addClass("select "+tableBrand.color+" glossy").styleSelect();
                    $("#btn-reset").addClass(tableBrand.color+" glossy");
                    tableBrand.tableStyled = true;
                }
            },
            columns:[
                {data: 'order', className:'align-center'},
                {data: 'name'},
                {data: 'visits', className:'align-center'},
                {data: 'description'},
                {data: 'status', className:'align-center'},
                {data:null, className:'details-control', orderable:false, searchable:false, defaultContent: ''}
            ],
            order: [[0, 'asc']]

        });
        $('#'+tableBrand.id).on('click', tableBrand.openDetails, function() {
            if (event.target !== this){
                return;
            }
            var tr = $(this).closest('tr'),
            row = table.row(tr);
            if (row.child.isShown()) {
                // Esta row já está aberta - fechá-la
                row.child.hide();
                tr.removeClass('shown');
                tr.children().removeClass(tableBrand.colorSel);
            } else {
                // Abrir esta row
                row.child(painel(row.data())).show();
                tr.addClass('shown');
                tr.children().addClass(tableBrand.colorSel);
            }
        });

        /**
         * create  e update
         * @param ac (opcional)
        */
        formBrand = function(ac)
        {
            var form = $('#form-'+tableBrand.id),
                url  = form.attr('action'),
                txt;
            (ac == 'create' ? txt = tableBrand.txtSave : txt = tableBrand.txtUpdate);

            $.ajax({
                type: 'POST',
                dataType: "json",
                url: url,
                data: form.serialize(),
                beforeSend: function() {
                    setBtn(4,'Aguarde',false,'loader','btn-modal',false,'silver');
                },
                success: function(data){
                    if(data.success == true){ 
                        if (ac == 'create') {
                            var count_brand = $("#count_brand").text(),
                                total_brand = parseFloat(count_brand)+1;                     
                            $("#count_brand").text(total_brand);
                        };                        
                        setBtn(4,txt,true,'icon-publish','btn-modal',false,'blue');
                        table.ajax.reload();
                        msgNotifica(true, data.message, true, false);
                        fechaModal();
                    } else {
                        setBtn(4,txt,true,'icon-publish','btn-modal',false,'blue');
                        msgNotifica(false, data.message, true, false);
                    }
                },
                error: function(xhr){
                    setBtn(4,txt,true,'icon-publish','btn-modal',false,'blue');
                    ajaxFormError(xhr);
                }
            });
        };

        /**
         * Delete Brand
         * @param string url, string name
        */
        deleteBrand = function(url, name)
        {
            $.modal.confirm(tableBrand.txtConfirm+' '+name+'?', function(){
                $.ajax({
                    type: 'DELETE',
                    dataType: "json",
                    headers: {'X-CSRF-TOKEN':tableBrand.token},
                    url: url,
                    success: function(data){
                        if(data.success == true){
                            var count_brand = $("#count_brand").text(),
                                total_brand = parseFloat(count_brand)-1;                     
                            $("#count_brand").text(total_brand);

                            var count_colors = $("#count_colors").html(),
                                total_colors = parseFloat(count_colors)-data.deleted.total_colors;
                                $("#count_colors").html(total_colors);
                                
                            var count_product = $("#count_product").html(),
                                total_product = parseFloat(count_product)-data.deleted.total_products;
                                $("#count_product").html(total_product);

                            table.ajax.reload();                
                            msgNotifica(true, data.message, true, false);
                        } else {
                            msgNotifica(false, data.message, true, false);
                        }
                    },
                    error: function(data){
                        ajaxFormError(xhr);
                    }
                });

            }, function(){
                $.modal.alert(tableBrand.txtCancel);
            });
        };

        /**
         * Form Grid
         * @param string ac
         * @param string id, 
         * @param string loader
         * @param string txt
        */
        formGridBrand = function(ac, id, loader, txt)
        {
            var form  = $('#form-'+id),
            token = $('#_token'),
            url   = form.attr('action');
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: url,
                data: form.serialize(),
                beforeSend: function() {
                    setBtn(4,loader,false,'loader','btn-modal',false,'silver');
                },
                success: function(json){
                    if(json.success == true){

                        if (json.type == 'unit') {
                            var icon = '<span class="icon-stop" title="Und"></span>&nbsp;';
                        }
                        if (json.type == 'kit') {
                            var icon = '<span class="icon-thumbs" title="Kit"></span>&nbsp;';
                        }

                        if (ac == 'update') {
                            $("#grid_"+json.id).html('<h3 class="thin underline">'+icon+' '+json.name+'</h3>'+
                                '<a href="javascript:void(0)" class="list-link">'+
                                '<strong> '+json.label+' </strong>'+
                                '</a>'+
                                '<div class="button-group absolute-right compact">'+
                                    "<button id=\"btn-edit\" onclick=\"abreModal('Alterar Grade: "+json.name+"', '"+json.url_edit+"', '"+id+"', 2, 'true', 400, 250);\" class=\"button icon-pencil blue-gradient\">Editar</button>"+
                                    "<button id=\"btn-delete\" onclick=\"deleteGrid('"+json.id+"', '"+json.name+"', '"+json.url_delete+"',  '"+json.token+"');\" class=\"button icon-trash with-tooltip red-gradient\" title=\"Excluir Grade\"></button>"+
                                '</div>');

                        } else {
                            $("#grids").prepend('<li id="grid_'+json.id+'">'+
                                '<h3 class="thin underline">'+icon+' '+json.name+'</h3>'+
                                '<a href="javascript:void(0)" class="list-link">'+
                                '<strong> '+json.label+' </strong>'+
                                '</a>'+
                                '<div class="button-group absolute-right compact">'+
                                    "<button id=\"btn-edit\" onclick=\"abreModal('Alterar Grade: "+json.name+"', '"+json.url_edit+"', '"+id+"', 2, 'true', 400, 250);\" class=\"button icon-pencil blue-gradient\">Editar</button>"+
                                    "<button id=\"btn-delete\" onclick=\"deleteGrid('"+json.id+"', '"+json.name+"', '"+json.url_delete+"', '"+json.token+"');\" class=\"button icon-trash with-tooltip red-gradient\" title=\"Excluir Grade\"></button>"+
                                '</div>');
                        }
                        fechaModal();
                        msgNotifica(true, json.message, true, false);
                    } else {
                        setBtn(4,txt,true,'icon-publish','btn-modal',false,'blue');
                        msgNotifica(false, json.message, true, false);
                    }
                },
                error: function(xhr){
                    setBtn(4,txt,true,'icon-publish','btn-modal',false,'blue');
                    ajaxFormError(xhr);
                }          
            });
        };

        /**
         * Delete Grid
         * @param int id
         * @param string name 
         * @param string url
         * @param string token
        */
        deleteGrid = function(id, name, url, token)
        {
            $.modal.confirm(tableBrand.txtConfirm+' '+name+'?', function(){
                $.ajax({
                    type: 'DELETE',
                    dataType: "json",
                    headers: {'X-CSRF-TOKEN':token},
                    url: url,
                    success: function(data){
                        if(data.success == true){
                            $("#grid_"+id).hide();
                            msgNotifica(true, data.message, true, false);
                        } else {
                            msgNotifica(false, data.message, true, false);
                        }
                    },
                    error: function(xhr){
                        ajaxFormError(xhr);
                    }
                });

            }, function(){
                $.modal.alert(tableBrand.txtCancel);
            });
        };


        /**
         * Peview Image
         * @param int id
         * @param int width 
        */
        preview_image = function(id, width)
        {
            $('#image_preview_'+id).html("");
            var total_file=document.getElementById("upload_file").files.length;
            for(var i=0;i<total_file;i++)
            {
                $('#image_preview_'+id).append('<img src="'+URL.createObjectURL(event.target.files[i])+'" width="'+width+'">');
            }
            $("#btn-upload-submit").show();
        };


        /**
         * Status Image
         * @param int id
         * @param string url
         * @param string token
        */
        statusImage = function(id, url, token)
        {
            $.ajax({
                type: 'POST',
                dataType: "json",
                headers: {'X-CSRF-TOKEN':token},
                url: url,
                data: {_method:'put'},
                beforeSend: function() {
                    $("#status-"+id).attr('class', 'button disabled');
                },
                success: function(data){
                    if(data.success == true){
                        $("#status-"+id).attr('class', data.class);
                        msgNotifica(true, data.message, true, false);
                    } else {
                        msgNotifica(false, data.message, true, false);
                    }
                },
                error: function(xhr){
                    ajaxFormError(xhr);
                }
            });
        }

        /**
         * Remove Image
         * @param int id
         * @param string url
         * @param string token
        */
        deleteImage = function(id, url, token)
        {
            $.ajax({
                type: 'POST',
                dataType: "json",
                headers: {'X-CSRF-TOKEN':token},
                url: url,
                data: {_method:'delete'},
                success: function(data){
                    if(data.success == true){
                        $("#img-"+id).remove();
                        msgNotifica(true, data.message, true, false);
                    } else {
                        msgNotifica(false, data.message, true, false);
                    }
                },
                error: function(xhr){
                    ajaxFormError(xhr);
                }
            });
        } 

        /**
         * Ajax Form
        */
        $("body").on("click","#btn-upload",function(e){
            $(this).parents("#form-image").ajaxForm(options);
        });

        var options = { 
            beforeSend: function() {
                setBtn(4,'Aguarde',false,'loader','btn-upload',false,'silver');
            },
            success: function(data) {
                if (data.success == true) {
                    setBtn(1,ac,true,'icon-cloud-upload','btn-upload');
                    if (data.ac == 'create') {
                        $("#gallery-"+data.idm).prepend(
                            '<li id="img-'+data.id+'">'+
                                '<img src="'+data.path+'" class="framed">'+
                                '<div class="controls">'+
                                    '<span id="btns-'+data.id+'" class="button-group compact children-tooltip">'+
                                        "<button id=\"status-"+data.id+"\" onclick=\""+data.url_status+"\" class=\""+data.class+"\" title=\""+data.btn.status+"\"></button>"+
                                        "<button id=\"edit-"+data.id+"\" onclick=\""+data.url_edit+"\" class=\"button\" title=\""+data.btn.edit+"\">"+data.btn.edit+"</button>"+
                                        "<button id=\"delete-"+data.id+"\" onclick=\""+data.url_delete+"\" class=\"button icon-trash red-gradient\" title=\""+data.btn.delete+"\"></button>"+
                                    '</span>'+
                                '</div>'+
                            '</li>');
                    }
                    if (data.ac == 'update') {
                        $("#img-"+data.id).html(
                                '<img src="'+data.path+'" class="framed">'+
                                '<div class="controls">'+
                                    '<span id="btns-'+data.id+'" class="button-group compact children-tooltip">'+
                                        "<button id=\"status-"+data.id+"\" onclick=\""+data.url_status+"\" class=\""+data.class+"\" title=\""+data.btn.status+"\"></button>"+
                                        "<button id=\"edit-"+data.id+"\" onclick=\""+data.url_edit+"\" class=\"button\" title=\""+data.btn.edit+"\">"+data.btn.edit+"</button>"+
                                        "<button id=\"delete-"+data.id+"\" onclick=\""+data.url_delete+"\" class=\"button icon-trash red-gradient\" title=\""+data.btn.delete+"\"></button>"+
                                    '</span>'+
                                '</div>');
                    }
                    fechaModal();
                    msgNotifica(true, data.message, true, false);
                } else {
                    msgNotifica(false, data.message, true, false);
                }
            },
            complete: function(data) {
                setBtn(4,'Upload',true,'icon-cloud-upload','btn-upload',false,'blue');
            },
            error: function(xhr) {
                ajaxFormError(xhr);
                setBtn(4,'Upload',true,'icon-cloud-upload','btn-upload',false,'blue');
            }
        };      

    }

})(jQuery);