(function($)
{
    $.fn.simSaveForm = function() 
    {
        this.filter('form').each(function(){captureForm(this);});

        function captureForm(formobj)
        {
            $(formobj).submit(function()
            {
                saveform(this);
            });
        }
        
        function saveform(formobj)
        {
            var formname = $(formobj).attr('name')||$(formobj).attr('id');
            if(!sessvars.simform)
            {
                sessvars.simform = {};
            }
            if(!sessvars.simform[formname])
            {
                sessvars.simform[formname]={};
                sessvars.simform[formname].vars={};
            }
            var fobj={};
            $(':input',formobj).each(function()
            {
                if(this.type == 'checkbox')
                {
                    if($("[name='"+this.name+"']").length > 1)
                    {
                        if(!fobj[this.name])
                        {
                            fobj[this.name]=[];
                        }
                        if($(this).is(':checked'))
                        {
                            fobj[this.name].push($(this).val());
                        }
                    }
                    else
                    {
                        fobj[this.name] = ($(this).is(':checked')) ? 1 :0;
                    }
                }
                else if(this.type == 'radio')
                {
                    var $rd = $("[name='"+this.name+"']:checked");
                    fobj[this.name] = ($rd.length < 1) ? null: $rd.val();
                }
                else
                {
                    fobj[this.name] = $(this).val();
                }
            });

            sessvars.simform[formname].vars = $.extend(sessvars.simform[formname].vars,fobj);
            sessvars.$.flush();
            //console.log(sessvars.simform[formname].vars);
        }
        
        return this;
    }  
})(jQuery);
function sfm_IsFormSaved(formname)
{
    if(typeof(sessvars) != "undefined" && typeof(sessvars.simform) != "undefined")
    {
        if(sessvars.simform[formname])
        {
            return true;
        }
    }
    return false;
}