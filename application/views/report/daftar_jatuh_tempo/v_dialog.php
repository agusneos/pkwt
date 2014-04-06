<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type="text/javascript">
    function cetak_daftar_jatuh_tempo()
    {
        
        var id = $('#year').combobox('getValue');
        var url = '<?php echo site_url('report/daftar_jatuh_tempo/cetak'); ?>/' + id;
        var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>';
        var title = 'Tahun ' + id;
        if (id != '')
        {
            if ($('#tt').tabs('exists', title))
            {
                $('#tt').tabs('select', title);
                $('#dlg').dialog('close');
            } 
            else 
            {
                $('#tt').tabs('add',{
                    title:title,
                    content:content,
                    closable:true,
                    iconCls:'icon-print'
                });
                $('#dlg').dialog('close');
            }
        }
        
    }
</script>
<style type="text/css">
    #fm-report_daftar_jatuh_tempo_dialog{
        margin:0;
        padding:20px 30px;
    }
    #dlg_btn-report_daftar_jatuh_tempo_dialog{
        margin:0;
        padding:10px 100px;
    }
    .ftitle{
        font-size:14px;
        font-weight:bold;
        padding:5px 0;
        margin-bottom:10px;
        border-bottom:1px solid #ccc;
    }
    .fitem{
        margin-bottom:5px;
    }
    .fitem label{
        display:inline-block;
        width:100px;
    }
</style>
<!-- Form -->
    <form id="fm-report_daftar_jatuh_tempo_dialog" method="post" novalidate buttons="#dlg_btn-report_daftar_jatuh_tempo_dialog">
        <div class="fitem">
            <label for="type">Tahun</label>
            <input id="year" class="easyui-combobox" name="year" data-options="
                url:'<?php echo site_url('report/daftar_jatuh_tempo/get_year'); ?>',
                method:'get', valueField:'year', textField:'year', panelHeight:'auto'" required/>
        </div>
    </form>

<!-- Dialog Button -->
<div id="dlg_btn-report_daftar_jatuh_tempo_dialog">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="cetak_daftar_jatuh_tempo()">Cetak</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Batal</a>
</div>


<!-- End of file v_dialog.php -->
<!-- Location: ./views/report/daftar_jatuh_tempo/v_dialog.php -->
