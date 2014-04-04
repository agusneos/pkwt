<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type="text/javascript">
    function cetak_habis_kontrak()
    {
        
        var id = $('#dept').combobox('getValue');
        var url = '<?php echo site_url('report/habis_kontrak/cetak'); ?>/' + id;
        var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>';
        var title = 'Departemen ID ' + id;
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
    #fm-report_habis_kontrak_dialog{
        margin:0;
        padding:20px 30px;
    }
    #dlg_btn-report_habis_kontrak_dialog{
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
    <form id="fm-report_habis_kontrak_dialog" method="post" novalidate buttons="#dlg_btn-report_habis_kontrak_dialog">
        <div class="fitem">
            <label for="type">Departemen</label>
            <input id="dept" class="easyui-combobox" name="departemen" data-options="
                url:'<?php echo site_url('report/habis_kontrak/get_dept'); ?>',
                method:'get', valueField:'dept_id', textField:'dept_name', panelHeight:'auto'" required/>
        </div>
    </form>

<!-- Dialog Button -->
<div id="dlg_btn-report_habis_kontrak_dialog">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="cetak_habis_kontrak()">Cetak</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Batal</a>
</div>


<!-- End of file v_dialog.php -->
<!-- Location: ./views/report/habis_kontrak/v_dialog.php -->
