<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type="text/javascript" src="<?=base_url('assets/easyui/datagrid-scrollview.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/easyui/datagrid-filter.js')?>"></script>
<script type="text/javascript">
var url;

function masterDepartemenCreate(){
    $('#dlg-master-departemen').dialog({modal: true}).dialog('open').dialog('setTitle','Tambah Data');
    $('#fm-master-departemen').form('clear');
    url = '<?php echo site_url('master/departemen/create'); ?>';
   
}

function masterDepartemenUpdate(){
    var row = $('#grid-master-departemen').datagrid('getSelected');
    if(row){
        $('#dlg-master-departemen').dialog({modal: true}).dialog('open').dialog('setTitle','Edit Data');
        $('#fm-master-departemen').form('load',row);
        url = '<?php echo site_url('master/departemen/update'); ?>/' + row['dept_id'];
    }
}

function masterDepartemenSave(){
    $('#fm-master-departemen').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if(result.success){
                $('#dlg-master-departemen').dialog('close');
                $('#grid-master-departemen').datagrid('reload');
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.msg
                });
            }
        }
    });
}

function masterDepartemenHapus(){
    var row = $('#grid-master-departemen').datagrid('getSelected');
    if (row){
        $.messager.confirm('Konfirmasi','Anda yakin ingin menghapus data ID '+row['dept_id']+' ?',function(r){
            if (r){
                $.post('<?php echo site_url('master/departemen/delete'); ?>',{dept_id:row['dept_id']},function(result){
                    if (result.success){
                        $('#grid-master-departemen').datagrid('reload');
                    } else {
                        $.messager.show({
                            title: 'Error',
                            msg: result.msg
                        });
                    }
                },'json');
            }
        });
    }
}

</script>
<style type="text/css">
    #fm-master-departemen{
        margin:0;
        padding:10px 30px;
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
        width:80px;
    }
</style>

<!-- Data Grid -->
<table id="grid-master-departemen" toolbar="#toolbar-master-departemen"
    data-options="pageSize:50, singleSelect:true, fit:true, fitColumns:true">
    <thead>
        <tr>              
            <th data-options="field:'dept_id'"      width="50"  align="center" sortable="true">ID</th>
            <th data-options="field:'dept_parent'"  width="50"  align="center" sortable="true">ID Departemen</th>
            <th data-options="field:'dept_name'"    width="80"  halign="center" sortable="true">Bagian</th>
            <th data-options="field:'workday_name'" width="200" halign="center" sortable="true">Hari Kerja</th>
            <th data-options="field:'emply_name'"   width="80"  halign="center" sortable="true">Manager</th>
        </tr>
    </thead>
</table>

<script type="text/javascript">
     $('#grid-master-departemen').datagrid({view:scrollview,remoteFilter:true,
        url:'<?php echo site_url('master/departemen/index'); ?>?grid=true'}).datagrid('enableFilter');
</script>
<!-- Toolbar -->
<div id="toolbar-master-departemen">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="masterDepartemenCreate()">Tambah Data</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="masterDepartemenUpdate()">Edit Data</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="masterDepartemenHapus()">Hapus Data</a>
</div>

<!-- Dialog Form -->
<div id="dlg-master-departemen" class="easyui-dialog" style="width:400px; height:250px; padding: 10px 20px" closed="true" buttons="#dlg-buttons-master-departemen">
    <form id="fm-master-departemen" method="post" novalidate>        
        <div class="fitem">
            <label for="type">Departemen</label>
            <input class="easyui-combobox" name="dept_parent" data-options="
                url:'<?php echo site_url('master/departemen/getParent'); ?>',
                method:'get', valueField:'dept_id', textField:'dept_name', panelHeight:'auto'">
        </div>
        <div class="fitem">
            <label for="type">Bagian</label>
            <input type="text" name="dept_name" class="easyui-validatebox" required="true"/>
        </div>
        <div class="fitem">
            <label for="type">Hari Kerja</label>
            <input class="easyui-combobox" name="dept_workday" data-options="
                url:'<?php echo site_url('master/departemen/getHariKerja'); ?>',
                method:'get', valueField:'workday_id', textField:'workday_name', panelHeight:'auto'">
        </div>
        <div class="fitem">
            <label for="type">Manager</label>
            <input class="easyui-combobox" name="dept_emply" data-options="
                url:'<?php echo site_url('master/departemen/getManager'); ?>',
                method:'get', valueField:'emply_nik', textField:'emply_name', panelHeight:'auto'">
        </div>
    </form>
</div>

<!-- Dialog Button -->
<div id="dlg-buttons-master-departemen">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="masterDepartemenSave()">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-master-departemen').dialog('close')">Batal</a>
</div>
