var TableAdvanced = function () {

     var initTable2 = function() {
        var oTable = $('#sample_2').dataTable( {           
            "aoColumnDefs": [
                { "aTargets": [ 0 ] }
            ],
             "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10000,
        });

        $(document).on('ifChanged', '.check_all', function(){
            if($(this).is(':checked')){
                $('.checkone').each(function(){
                    $(this).attr('checked',true).iCheck({
                        checkboxClass: 'icheckbox_minimal-blue'
                    });
                    $(this).closest('div').addClass('checked');
                    var iCol = parseInt($(this).attr("data-column"));
                    var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
                    oTable.fnSetColumnVis(iCol, (bVis ? false : true));
                });
            }
            else
            {
                $('.checkone').each(function(){
                    $(this).attr('checked',false).iCheck({
                        checkboxClass: 'icheckbox_minimal-blue'
                    });
                    var iCol = parseInt($(this).attr("data-column"));
                    var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
                    oTable.fnSetColumnVis(iCol, (bVis ? false : true));
                });
            }
        });
        $(document).on('ifChanged','#sample_2_column_toggler input[type="checkbox"]',function(){
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            
            if (!jQuery().dataTable) {
                return;
            }

            
            initTable2();
        }

    };

}();