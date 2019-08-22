<?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css',['block'=>'select2css']) ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',['block'=>'select2js']) ?>

<?php

$js ="
    $(document).ready(function() {
        $('.select4').select2();
        var URL = '".$this->Url->build(['controller'=>'Books','action'=>'getBook.json'])."';

            $('".$selector."').select2({
                minimumInputLength: 3,
                ajax: { 
                    url: URL,
                    type: 'post',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {

                        return {
                            table: '".$table."',
                            key: $(this).attr('keyField'),
                            field: $(this).attr('valueField'),
                            value: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: $.map(response.response, function (item) {
                                console.log(item);
                                return {
                                    text: item.text,
                                    id: item.key
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
    });
";
$this->Html->scriptBlock($js, ['block' => 'scriptPageBottom']);
?>