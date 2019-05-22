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
 * My Profile
 *
 */
;(function($, undefined)
{  

    /**
     * update
     * @param id loader txt
    */
    formMyProfile = function(id, loader, txt)
    {
        var form = $('#form-'+id),
            url  = form.attr('action');
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: url,
            data: form.serialize(),
            beforeSend: function() {
                setBtn(4,loader,false,'loader','btn-modal',false,'silver');
            },
            success: function(data){
                if(data.success == true){
                    setBtn(4,txt,true,'icon-publish','btn-modal',false,'blue');
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
})(jQuery);