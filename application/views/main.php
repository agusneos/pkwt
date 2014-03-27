<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>   
    <meta charset="UTF-8">
    <title>HRIS | Human Resource Information System</title>
    <link rel="icon" type="image/png" href="<?=base_url('assets/easyui/themes/icons/chart.png')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/easyui/themes/default/easyui.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/easyui/themes/icon.css')?>">
    <script type="text/javascript" src="<?=base_url('assets/easyui/jquery.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/easyui/jquery.easyui.min.js')?>"></script>
    <script type="text/javascript">        
        function addTab(title, url, iconCls){
            if ($('#tt').tabs('exists', title)){
                $('#tt').tabs('select', title);
            } else {
                if ( url != "kosong")
                {
                    $('#tt').tabs('add',{
                        title:title,                    
                        href:url,
                        closable:true,
                        iconCls:iconCls,
                    })
                }
            }            
        }
        
        function dashboardTab(title){
            if ($('#tt').tabs('exists', title)){
                $('#tt').tabs('select', title);
            } 
        }
        
    </script>
    
    
    
</head>
<body>    
    
    <div class="easyui-layout" fit="true" style="width:700px;height:350px;">
        <div data-options="region:'north',border:true,split:true" style="height:34px" > 
            <div class="easyui-layout" data-options="fit:true" >
                <div data-options="region:'east',split:false,border:false" style="width:300px;background-color:#daeef5">                   
                    <div align='right' >
                        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-user'" >
                            <?php echo $this->session->userdata('nama');?>,
                            <?php echo $this->session->userdata('user_id');?>,
                            <?php 
                            setlocale (LC_TIME, 'INDONESIAN');
                            $st = strftime( "%A, %d %B %Y", strtotime(date('d-F-Y')));
                            echo $st;
                            ?>
                        </a>                        
                    </div>            
                </div>
                <div data-options="region:'center',split:false,border:false" style="background-color:#daeef5">
                    <div>        
                        <a href="javascript:void(0)" onclick="dashboardTab('Dashboard')" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-dashboard'">Dashboard</a>
                        <a href="<?php echo site_url('welcome/logout'); ?>" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-logout'">Logout</a>                        
                    </div>
                </div>
            </div>
            
        </div> 
        <!-- bottom -->
        <div data-options="region:'south',split:true" style="height:50px;"></div>
        
        <!-- left -->
        <div data-options="region:'west',split:true" title="Main Menu" iconCls="icon-menu" style="width:200px;">            
            <ul id="ttr" class="easyui-tree" lines="true" animate="true" style="padding:5px"></ul>                
        </div>
        
        <!-- center -->
        <div data-options="region:'center'">
            <div id="tt" class="easyui-tabs" data-options="fit:true,border:false,plain:true" >
                <div title="Dashboard" data-options="closable:false,href:'dashboard',iconCls:'icon-dashboard'" style="padding:10px"></div>
            </div>             
        </div>
    </div>
    
    <script type="text/javascript">
        $('#ttr').tree({
        url:'<?php echo site_url('menu/index'); ?>',
        onClick: function(node){
            addTab(node.text, node.uri, node.iconCls);
	}
    });
    </script>
    
    
</body>
</html>