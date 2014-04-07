<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript" src="<?=base_url('assets/easyui/datagrid-scrollview.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/easyui/datagrid-filter.js')?>"></script>
<script type="text/javascript">
var url;

function masterJabatanCreate(){
    $('#dlg-master-jabatan').dialog({modal: true}).dialog('open').dialog('setTitle','Tambah Data');
    $('#fm-master-jabatan').form('clear');
    url = '<?php echo site_url('master/jabatan/create'); ?>';
}

function masterJabatanUpdate(){
    var row = $('#grid-master-jabatan').datagrid('getSelected');
    if(row){
        $('#dlg-master-jabatan').dialog({modal: true}).dialog('open').dialog('setTitle','Edit Data');
        $('#fm-master-jabatan').form('load',row);
        url = '<?php echo site_url('master/jabatan/update'); ?>/' + row.post_id;
    }
}

function masterJabatanSave(){
    $('#fm-master-jabatan').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if(result.success){
                $('#dlg-master-jabatan').dialog('close');
                $('#grid-master-jabatan').datagrid('reload');
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.msg
                });
            }
        }
    });
}

function masterJabatanHapus(){
    var row = $('#grid-master-jabatan').datagrid('getSelected');
    if (row){
        $.messager.confirm('Konfirmasi','Anda yakin ingin menghapus data ID '+row.post_id+' ?',function(r){
            if (r){
                $.post('<?php echo site_url('master/jabatan/delete'); ?>',{post_id:row.post_id},function(result){
                    if (result.success){
                        $('#grid-master-jabatan').datagrid('reload');
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
    #fm-master-jabatan{
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
<table id="grid-master-jabatan" toolbar="#toolbar-master-jabatan"
    data-options="pageSize:50, singleSelect:true, fit:true, fitColumns:false">
    <thead>
        <tr>              
            <th data-options="field:'post_id'" width="50" align="center" sortable="true">ID</th>
            <th data-options="field:'post_name'" width="300" halign="center" sortable="true">Nama Jabatan</th>
        </tr>
    </thead>
</table>

<script type="text/javascript">
    $('#grid-master-jabatan').datagrid({view:scrollview,remoteFilter:true,
        url:'<?php echo site_url('master/jabatan/index'); ?>?grid=true'}).datagrid('enableFilter');
</script>
<!-- Toolbar -->
<div id="toolbar-master-jabatan">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="masterJabatanCreate()">Tambah Data</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="masterJabatanUpdate()">Edit Data</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="masterJabatanHapus()">Hapus Data</a>
</div>

<!-- Dialog Form -->
<div id="dlg-master-jabatan" class="easyui-dialog" style="width:400px; height:250px; padding: 10px 20px" closed="true" buttons="#dlg-buttons-master-jabatan">
    <form id="fm-master-jabatan" method="post" novalidate>        
        <div class="fitem">
            <label for="type">Nama Jabatan</label>
            <input type="text" name="post_name" class="easyui-validatebox" required="true"/>
        </div>
    </form>
</div>

<!-- Dialog Button -->
<div id="dlg-buttons-master-jabatan">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="masterJabatanSave()">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-master-jabatan').dialog('close')">Batal</a>
</div>
