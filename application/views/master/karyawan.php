<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript" src="<?=base_url('assets/easyui/datagrid-scrollview.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/easyui/datagrid-filter.js')?>"></script>
<script type="text/javascript">
var url;

function masterKaryawanCreate(){
    $('#dlg-master-karyawan').dialog({modal: true}).dialog('open').dialog('setTitle','Tambah Data');
    $('#fm-master-karyawan').form('clear');
    url = '<?php echo site_url('master/karyawan/create'); ?>';
}

function masterKaryawanUpdate(){
    var row = $('#grid-master-karyawan').datagrid('getSelected');
    if(row){
        $('#dlg-master-karyawan').dialog({modal: true}).dialog('open').dialog('setTitle','Edit Data');
        $('#fm-master-karyawan').form('load',row);
        url = '<?php echo site_url('master/karyawan/update'); ?>/' + row.emply_nik;
    }
}

function masterKaryawanSave(){
    $('#fm-master-karyawan').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if(result.success){
                $('#dlg-master-karyawan').dialog('close');
                $('#grid-master-karyawan').datagrid('reload');
                
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.msg
                });                
            }
        }
    });
}

function masterKaryawanHapus(){
    var row = $('#grid-master-karyawan').datagrid('getSelected');
    if (row){
        $.messager.confirm('Konfirmasi','Anda yakin ingin menghapus data NIK '+row.emply_nik+' ?',function(r){
            if (r){
                $.post('<?php echo site_url('master/karyawan/delete'); ?>',{emply_nik:row.emply_nik},function(result){
                    if (result.success){
                        $('#grid-master-karyawan').datagrid('reload');
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
    #fm-master-karyawan{
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
        width:100px;
    }
</style>

<!-- Data Grid -->
<table id="grid-master-karyawan" toolbar="#toolbar-master-karyawan"
    data-options="pageSize:50, singleSelect:true, fit:true, fitColumns:false">

    <thead>
        <tr>              
            <th data-options="field:'emply_nik'" width="50" align="center" sortable="true">NIK</th>
            <th data-options="field:'emply_ac'" width="50" align="center" sortable="true">Absen</th>
            <th data-options="field:'emply_name'" width="100" halign="center" sortable="true">Nama</th>
            <th data-options="field:'emply_sex'" width="100" align="center" sortable="true">Jenis Kelamin</th>
            <th data-options="field:'emply_bop'" width="100" halign="center" sortable="true">Tempat Lahir</th>
            <th data-options="field:'emply_bod'" width="100" align="center" sortable="true">Tanggal Lahir</th>
            <th data-options="field:'emply_relig'" width="100" align="center" sortable="true">Agama</th>
            <th data-options="field:'emply_marital'" width="100" align="center" sortable="true">Status Kawin</th>
            <th data-options="field:'emply_ktp'" width="100" halign="center" sortable="true">KTP</th>
            <th data-options="field:'emply_add'" width="100" halign="center" sortable="true">Alamat</th>
            <th data-options="field:'emply_city'" width="100" halign="center" sortable="true">Kota</th>
            <th data-options="field:'emply_zip'" width="100" align="center" sortable="true">Kode Pos</th>
            <th data-options="field:'emply_phone'" width="100" align="center" sortable="true">Telepon</th>
            <th data-options="field:'emply_cell'" width="100" align="center" sortable="true">HP</th>
            <th data-options="field:'emply_start'" width="100" align="center" sortable="true">Tanggal Masuk</th>
            <th data-options="field:'emply_status'" width="100" align="center" sortable="true">Status Karyawan</th>
            <th data-options="field:'bank_name'" width="100" align="center" sortable="true">Bank</th>
            <th data-options="field:'emply_rek'" width="100" align="center" sortable="true">No. Rekening</th>
            <th data-options="field:'emply_active'" width="100" align="center" sortable="true">Masih bekerja</th>
            <th data-options="field:'emply_end'" width="100" align="center" sortable="true">Tanggal Keluar</th>
        </tr>
    </thead>
</table>

<!-- Toolbar -->
<div id="toolbar-master-karyawan">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="masterKaryawanCreate()">Tambah Data</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="masterKaryawanUpdate()">Edit Data</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="masterKaryawanHapus()">Hapus Data</a>
</div>

<!-- Dialog Form -->
<div id="dlg-master-karyawan" class="easyui-dialog" style="width:400px; height:650px; padding: 10px 20px" closed="true" buttons="#dlg-buttons-master-karyawan">
    <form id="fm-master-karyawan" method="post" novalidate>        
        <div class="fitem">
            <label for="type">NIK</label>
            <input name="emply_nik" class="easyui-numberbox" required />
        </div>
        <div class="fitem">
            <label for="type">Absen</label>
            <input name="emply_ac" class="easyui-numberbox" />
        </div>
        <div class="fitem">
            <label for="type">Nama</label>
            <input type="text" name="emply_name" class="easyui-validatebox" required />
        </div>
        <div class="fitem">
            <label for="type">Jenis Kelamin</label>
            <input class="easyui-combobox" name="emply_sex" required data-options="
                url:'<?php echo site_url('master/karyawan/enumEmplySex'); ?>',
                method:'get', valueField:'data', textField:'data', panelHeight:'auto'" />
        </div>
        <div class="fitem">
            <label for="type">Tempat Lahir</label>
            <input type="text" name="emply_bop" class="easyui-validatebox" required="true"/>
        </div>
        <div class="fitem">
            <label for="type">Tanggal Lahir</label>
            <input name="emply_bod" class="easyui-datebox" required data-options="
                formatter:masterKaryawanFormatter, parser:masterKaryawanParser" />            
        </div>
        <div class="fitem">
            <label for="type">Agama</label>
            <input class="easyui-combobox" name="emply_relig" required data-options="
                url:'<?php echo site_url('master/karyawan/enumEmplyRelig'); ?>',
                method:'get', valueField:'data', textField:'data', panelHeight:'auto'" />
        </div>
        <div class="fitem">
            <label for="type">Status Kawin</label>
            <input class="easyui-combobox" name="emply_marital" required data-options="
                url:'<?php echo site_url('master/karyawan/enumEmplyMarital'); ?>',
                method:'get', valueField:'data', textField:'data', panelHeight:'auto'" />
        </div>
        <div class="fitem">
            <label for="type">KTP</label>
            <input name="emply_ktp" class="easyui-numberbox" required />
        </div>
        <div class="fitem">
            <label for="type">Alamat</label>
            <input type="text" name="emply_add" class="easyui-validatebox" required />
        </div>
        <div class="fitem">
            <label for="type">Kota</label>
            <input type="text" name="emply_city" class="easyui-validatebox" required />
        </div>
        <div class="fitem">
            <label for="type">Kode Pos</label>
            <input name="emply_zip" class="easyui-numberbox" />
        </div>
        <div class="fitem">
            <label for="type">Telepon</label>
            <input name="emply_phone" class="easyui-numberbox" />
        </div>
        <div class="fitem">
            <label for="type">HP</label>
            <input name="emply_cell" class="easyui-numberbox" />
        </div>
        <div class="fitem">
            <label for="type">Tanggal Masuk</label>
            <input name="emply_start" class="easyui-datebox" required data-options="
                formatter:masterKaryawanFormatter, parser:masterKaryawanParser" />
        </div>
        <div class="fitem">
            <label for="type">Status Karyawan</label>
            <input class="easyui-combobox" name="emply_status" required data-options="
                url:'<?php echo site_url('master/karyawan/enumEmplyStatus'); ?>',
                method:'get', valueField:'data', textField:'data', panelHeight:'auto'" />
        </div>
        <div class="fitem">
            <label for="type">Bank</label>
            <input class="easyui-combobox" name="emply_bank" data-options="
                url:'<?php echo site_url('master/karyawan/getBank'); ?>',
                method:'get', valueField:'bank_id', textField:'bank_name', panelHeight:'auto'" />
        </div>
        <div class="fitem">
            <label for="type">No. Rekening</label>
            <input name="emply_rek" class="easyui-numberbox" />
        </div>
        <div class="fitem">
            <label for="type">Masih bekerja</label>
            <input class="easyui-combobox" name="emply_active" required data-options="
                url:'<?php echo site_url('master/karyawan/enumEmplyActive'); ?>',
                method:'get', valueField:'data', textField:'data', panelHeight:'auto'" />
        </div>
        <div class="fitem">
            <label for="type">Tanggal Keluar</label>
            <input name="emply_end" class="easyui-datebox" data-options="
                formatter:masterKaryawanFormatter, parser:masterKaryawanParser" />
        </div>
        
    </form>
</div>
<script type="text/javascript">
    $('#grid-master-karyawan').datagrid({view:scrollview,remoteFilter:true,
        url:'<?php echo site_url('master/karyawan/index'); ?>?grid=true'}).datagrid('enableFilter');
    
    function masterKaryawanFormatter(date){
        var y = date.getFullYear();
        var m = date.getMonth()+1;
        var d = date.getDate();
        return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
    }
    function masterKaryawanParser(s){
        if (!s) return new Date();
        var ss = (s.split('-'));
        var y = parseInt(ss[0],10);
        var m = parseInt(ss[1],10);
        var d = parseInt(ss[2],10);
        if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
            return new Date(y,m-1,d);
        } else {
            return new Date();
        }
    }
    
</script>
<!-- Dialog Button -->
<div id="dlg-buttons-master-karyawan">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="masterKaryawanSave()">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-master-karyawan').dialog('close')">Batal</a>
</div>
