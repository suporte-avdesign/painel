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
 * Colors
 *
 */
;(function($, undefined)
{
    /**
     * Init table
     * @var array 
     */
    $.fn.loadTableColors = function()
    {  
        var table = $("#"+tableColor.id).DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: tableColor.url,
                type: "POST",
                dataType: "json",
                headers: {'X-CSRF-TOKEN': tableColor.token}
            },
            sScrollX: true,
            sScrollXInner: "100%",
            buttons: ['reset'],
            sPaginationType: "full_numbers",
            iDisplayLength: tableColor.limit,
            sDom: 'CB<"clear"><"dataTables_header"lfr>t<"dataTables_footer"ip>',
            fnDrawCallback: function( oSettings ){
                if (!tableColor.tableStyled){
                    $("#"+tableColor.id).closest(".dataTables_wrapper").find(".dataTables_length select").addClass("select "+tableColor.color+" glossy").styleSelect();
                    $("#btn-reset").addClass(tableColor.color+" glossy");
                    tableColor.tableStyled = true;
                }
            },
            columns:[
                { data: null, searchable:false, render: function ( data, type, row ) 
                    {
                        return data.image;
                    } 
                },
                {data: 'code'},
                {data: 'color'},
                {data: 'category'},
                {data: 'section'},
                {data: 'brand'},
                {data: 'visits', className:'align-center'},
                {data: "active", className:'align-center'},
                {
                    data: 'actions', 
                    className: 'align-right',
                    orderable: false,
                    searchable: false,
                    defaultContent: ''
                }
            ],
            order: [[0, 'desc']]

        });


        /**
         * Update Status.
         *
         * @param int id
         * @param string url
         * @param int sta
         * @param int cover
         * @param string token
         */
        statusColors = function(id, url, sta, cover, token)
        {
            var status;
            (sta == 1 ? status = 0 : status = 1);            
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN':token},
                dataType: "json",
                url: url,
                data: {_method:'put', 'active':status},
                success: function(data){
                    if(data.success == true){
                        if (cover == 1 && status == 0) {
                            $.modal.alert('<span class="red">'+data.alert+'</span>');
                        };
                        $("#status-"+id).html(data.html);
                        msgNotifica(true, data.message, true, false);
                    } else {
                        msgNotifica(false, data.message, true, false);
                    }
                },
                error: function(xhr){
                    ajaxFormError(xhr);
                }
            });
        };



        /**
         * Peview Image
         * @param int id
         * @param int width 
        */
        preview_image = function(arq,prev,width)
        {
            $('#'+prev).html("");
            var total_file=document.getElementById(arq).files.length;
            for(var i=0;i<total_file;i++)
            {
                $('#'+prev).append('<img src="'+URL.createObjectURL(event.target.files[i])+'" width="'+width+'">');
            }
        };


        /**
         * Add grid Image
         * @param int id
        */
        addGrid = function(id, stock)
        {
            //Number Random
            var num = Math.random(),
                html;
            if (stock == 1) {
                html = '<li class="new_grid">';
                    html += '<span class="input">';
                        html += '<input type="text" name="grids['+num+'][grid]" id="grid_'+id+'" class="input-unstyled input-sep" value="" maxlength="4" style="width: 30px;">';
                        html += '<input type="text" name="grids['+num+'][entry]" id="entry_'+id+'" class="input-unstyled input-sep" value="" maxlength="4" style="width: 30px;">';
                        html += '<input type="text" name="grids['+num+'][low]" id="exit_'+id+'" class="input-unstyled input-sep" value="0" style="width: 30px;">';
                    html += '</span>';
                    html += '<div class="button-group absolute-right compact">';
                        html += '<button onclick="removeThis(this,\'.new_grid\');" class="button icon-trash with-tooltip" title="Excluir"></button>';
                    html += '</div>';
                html += '</li>';
            } else {
                html = '<li class="new_grid">';
                    html += '<span class="input">';
                        html += '<input type="text" name="grids['+num+'][grid]" id="grid_'+id+'" class="input-unstyled input-sep" value="" maxlength="4" style="width: 30px;">';
                    html += '</span>';
                    html += '<div class="button-group absolute-right compact">';
                        html += '<button onclick="removeThis(this,\'.new_grid\');" class="button icon-trash with-tooltip" title="Excluir"></button>';
                    html += '</div>';
                html += '</li>';
            }   

            $("#grids-"+id).append(html);
        }


        /**
         * Remove this grid
         * @param object _this
         * @param int id
        */
        removeThis = function(_this, id)
        {
            $(_this).parents(id).remove();
        }

        /**
         * Excluir imagem cor.
         * @param int id
         */

        deleteColor = function(id, url)
        {
            $.ajax({
                type: 'DELETE',
                dataType: "json",
                url: url,
                headers: {'X-CSRF-TOKEN':tableColor.token},
                success: function(data){
                    if(data.success == true){
                        table.ajax.reload();
                        msgNotifica(true, data.message, true, false);
                    } else {
                        msgNotifica(false, data.message, true, false);
                    }
                },
                error: function(xhr){
                    ajaxFormError(xhr);
                }
            });
        };

        $("body").on("click","#btn-colors",function(e){
            $(this).parents("#form-colors").ajaxForm(opc_colors);
        });
        var opc_colors = { 
            beforeSend: function() {
                setBtn(1,'Aguarde',false,'loader disbeled','submit-colors','btn-colors');
            },
            success: function(data) {
                if (data.success == true) {
                    $("#img-"+data.id).attr('src', data.image);
                    $("#code-"+data.id).html(data.code);
                    $("#color-"+data.id).html(data.color);
                    fechaModal();
                    msgNotifica(true, data.message, true, false);
                } else {
                    msgNotifica(false, data.message, true, false);
                    setBtn(1,'Salvar',true,'icon-tick','submit-colors','btn-colors');                    
                }
            },
            error: function(xhr)
            {
                ajaxFormError(xhr);
                setBtn(1,'Salvar',true,'icon-tick','submit-colors','btn-colors');
            }
        }; 

    }

})(jQuery);