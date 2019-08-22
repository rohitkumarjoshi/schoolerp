<style type="text/css">
    .report-logo{
        align-content: center;
        display: ruby-base-container;
        position: absolute;
    }
    .report-header
    {
        display: none;
    }
</style>
<style type="text/css" media="print">
    .box-header{
        display: none;
    }
    .report-header{
        display: block;
    }
    .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td 
    {
        border: 1px solid #0c0c0c !important;
    }
</style>
<div class="report-header">
    <div class="report-logo">
        <?= $this->Html->image('school_logo/reportlogo.png',['style'=>  'height: 120px;']) ?> 
    </div>
    <table width="100%"  align="center"  cellpadding="0" cellspacing="0"  >
        <tbody>
            <tr>
                <td  align="center" style="font-size:25px">
                    <b style="text-transform: uppercase;"><?= $school->name ?></b>
                </td>
            </tr>
            <tr>
                <td align="center" >
                    <B><I>(<?= $school->affiliation_no ?>)</I></B>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <b><?= $school->address ?></b>
                </td>
            </tr>
            <tr>
                <td align="center"   style="font-size:20px">
                    <b>(<?= $school->agis ?>)</b>
                </td>
            </tr>
            <tr>
                <td align="center"   style="font-size:20px">
                    <b><?= $auth->User('session_name') ?></b>
                </td>
            </tr>
        </tbody>
    </table> 
</div>