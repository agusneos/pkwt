<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript" src="<?=base_url('assets/easyui/datagrid-scrollview.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/easyui/datagrid-filter.js')?>"></script>
<script type="text/javascript">   
    var url;
    
    function printPkwt()
    {
        var row = $('#grid-dashboard').datagrid('getSelected');
        var url = '<?php echo site_url('transaksi/pkwt/cetak_pkwt'); ?>/' + row.pkwt_id;
        var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>'
        var title = 'PKWT ID ' + row.pkwt_id;
        if ($('#tt').tabs('exists', title)){
            $('#tt').tabs('select', title);
        } else {
            $('#tt').tabs('add',{
                title:title,
                content:content,
                closable:true,
                iconCls:'icon-print'
            })
        }
    }

    function printEvaluasi()
    {
        var row = $('#grid-dashboard').datagrid('getSelected');
        var url = '<?php echo site_url('transaksi/pkwt/cetak_evaluasi'); ?>/' + row.pkwt_id;
        var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>'
        var title = 'Evaluasi ID ' + row.pkwt_id;
        if ($('#tt').tabs('exists', title)){
            $('#tt').tabs('select', title);
        } else {
            $('#tt').tabs('add',{
                title:title,
                content:content,
                closable:true,
                iconCls:'icon-print'
            })
        }
    }
</script>
<style type="text/css">
    #fm-dashboard{
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
<table id="grid-dashboard" toolbar="#toolbar-dashboard"
    data-options="pageSize:50, singleSelect:true, fit:true, fitColumns:true">
    <thead>
        <tr>              
            <th data-options="field:'pkwt_id'" width="60" align="center" sortable="true">No. PKWT</th>
            <th data-options="field:'pkwt_kk'" width="50" align="center" sortable="true">Kontrak</th>
            <th data-options="field:'emply_name'" width="140" halign="center" sortable="true">Nama</th>
            <th data-options="field:'dept_name'" width="100" halign="center" sortable="true">Bagian</th>
            <th data-options="field:'post_name'" width="100" align="center" sortable="true">Jabatan</th>
            <th data-options="field:'pkwt_status'" width="100" align="center" sortable="true">Status</th>
            <th data-options="field:'pkwt_start'" width="80" align="center" sortable="true">Awal Kontrak</th>
            <th data-options="field:'pkwt_period'" formatter="transaksiPkwtPeriod" width="60" align="center" sortable="true">Jangka</th>
            <th data-options="field:'pkwt_end'" width="80" align="center" sortable="true">Akhir Kontrak</th>
            <th data-options="field:'pkwt_sign'" width="80" align="center" sortable="true">Tanggal PKWT</th>            
        </tr>
    </thead>
</table>

<!-- Toolbar -->
<div id="toolbar-dashboard" >
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="printEvaluasi()">Cetak Evaluasi</a>          
</div>
<!-- Dialog Form -->


<script type="text/javascript">
    $(function() {
        function grid_refresh() {
            $('#grid-dashboard').datagrid('reload'); // reload grid
            setTimeout(grid_refresh, 15000); // schedule next refresh after 15sec
        }
        $('#grid-dashboard').datagrid({view:scrollview,remoteFilter:true,
            url:'<?php echo site_url('dashboard/index'); ?>?grid=true'}).datagrid('enableFilter');
        grid_refresh();
    });
                
    function transaksiPkwtFormatter(date){
        var y = date.getFullYear();
        var m = date.getMonth()+1;
        var d = date.getDate();
        return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
    }
    function transaksiPkwtParser(s){
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
    function transaksiPkwtSpcSalary(value,row,index) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    function transaksiPkwtPeriod(value,row,index) {
        if (value == 0){
            return value;
        } else {
            return value +' Bulan';
        }        
    }

</script>
<!-- Dialog Button -->

