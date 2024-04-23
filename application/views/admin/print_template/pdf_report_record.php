<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
   <head>
      <base href="<?php echo base_url(); ?>" />
      <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>PDF Report <?php echo $from; ?> </title>
	  <style>
        @page {
            header: cover;
            margin-top: 120px;
            footer: page_next_last;
        }
        
        @page :first {    
            header: cover;
            <?php printf("footer: page_footer;"); ?>
        }
        
        @page :last {
            footer: page_footer;   
        }
        
        htmlpageheader, htmlpagefooter {
     	   display: none;
           padding: 0;
    	}
    	
    	html {
    	sheet-size: Legal-L;
    	}
        
        body {
            color: #141313;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 16px;
        }
        table { 
            width: 100%
        }
        table.items {
            width: 100%;
            border-top: 1px solid #000;
            border-left: 1px solid #000;
        }
        
        table.items th {
            padding-left: 5px;
        }
        
        table.items tr td {
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            padding-left: 8px;
            padding-bottom: 10px;
        }
        
        table.items tr td:first-child {
            border-left: 1px solid #000;
        }
        
        tr.row {
            table-layout: fixed; 
            page-break-inside: avoid;
            border-top: 1px solid #000;
        }
        
        tr.header th {
            text-align: center;
        }

        .displaytop{
            font-size: 12px;
            border-right: 1px solid #000;
            padding: 5px;
        }

        .bottom_text{
            width: 100%;
            table-layout: fixed;
            border: 1px solid #000; 
            padding:10px ; margin-bottom: 0;
            margin-top: 20px;
            
        }
      </style>
   </head>
   <body>
   <table valign="top" cellspacing="0" width="800" style="table-layout: fixed; border: none; width: 100%;margin-top: -60px;">
    	<tr><td colspan="3"> </td></tr>
    	<tr>
    		<td width="266" style="font-size: 8px; font-family: mono"> </td>
    		<td width="266" style="font-size: 8px; font-family: mono; text-align: center;"> </td>
    		<td width="266" style="font-size: 8px; font-family: mono; text-align: right;"><?php echo $date_now; ?> / <?php echo ucwords( $this->session->userdata('staff_fname').' '.$this->session->userdata('staff_lname') ); ?></td>
    	</tr>
    </table>
            <h3 style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-weight: 400;margin-bottom: -10px;"> Council for the Welfare of Children </h3>
            <h3 style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-weight: 400;margin-bottom: 30px;"> Records Management Office </h3>
    
   		    <h3 style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-weight: 400;margin-bottom: -5px"><?php echo $division; ?></h3>
           <h3 style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-weight: 400; margin-bottom: 30px;"><?php echo $from; ?></h3>
   		

        <table cellspacing="0" cellpadding="0" width="800" style="border: 1px solid #000; margin-bottom: 10px;">
        	<tr>
        		<th width="90"  class="displaytop">Document No.</th>
        		<th width="90"  class="displaytop">Document Type</th>
        		<th width="90"  class="displaytop">Document Title</th>
        		<th width="90"  class="displaytop">Source</th>
        		<th width="90"  class="displaytop">Routed To</th>
        		<th width="90"  class="displaytop">Date Received</th>
        		<th width="90"  class="displaytop">Concerned Staff</th>
        		<th width="90"  class="displaytop">Status</th>
        		<th width="90"  class="displaytop">Notes / Remarks</th>
        	</tr>
        </table>
    <table valign="top" cellpadding="1" cellspacing="0" width="800" class="items" style="table-layout: fixed; width: 100%;">
       <?php if (!empty($posts) ) {
           printf('<tbody >');
           foreach ($posts as $post)   { ?>
            <tr class="row">
        		<td width="90"  > <?php echo $post['dd_doc_id_code']; ?> </td>
        		<td width="200" style="font-size: 11px">
                    <?php if ($post['dd_doct_type'] == 0): ?>
                        Multiple
                    <?php else: ?>
                        <?php echo $post['dt_name']; ?>
                    <?php endif ?>
                </td>
        		<td width="90"  > <?php echo $post['dd_title']; ?> </td>
        		<td width="90">
                    <?php $dd_action_taken_id = $post['dd_source']; 
                    
                       $dd_action_id = explode(", ", $dd_action_taken_id);

                       $dd_action_name = '';
                       foreach($dd_action_id as $mysource){
                            $this->load->model('Model_records', 'records'); 
                           $data = $this->records->mysources($mysource);
                           $dd_action_name .= $data['ds_name'] . ', ';
                           $dd_name =  substr($dd_action_name, 0, -2);
                       }
                       echo $dd_name;
                    ?>
                </td>
        		<td width="120"> <?php echo $post['dd_view_doc']; ?> </td>
        		<td width="90">
                    <?php $date = $post['dd_date_routed'];  
                    $datepicker = date("M-d-Y h:i A", strtotime($date)); ?>
                    <?php echo $datepicker; ?>
                </td>
        		<td width="90" style="font-size: 11px"> <?php echo $post['dd_staff_name']; ?> </td>
        		<td width="90" > 
                    <?php switch ($post['dd_status']){
                        case 0:
                            echo '<span class="px-2 py-1 rounded-full bg-theme-6 text-white mr-1"> For Receiving </span>';
                        break;
                        case 1:
                            echo '<span class="px-2 py-1 rounded-full bg-theme-6 text-white mr-1"> Pending </span>';
                        break;
                        case 2:
                            echo '<span class="px-2 py-1 rounded-full bg-theme-12 text-white mr-1"> On Process </span>';
                        break;
                        case 3:
                            echo '<span class="px-2 py-1 rounded-full bg-theme-1 text-white mr-1"> Re process </span>';
                        break;
                        case 4:
                            echo '<span class="px-2 py-1 rounded-full bg-theme-9 text-white mr-1"> Completed </span>';
                        break;
                        default:
                            echo '<span class="px-2 py-1 rounded-full bg-theme-9 text-white mr-1"> Forwarded </span>';
                        break;  
                    }?>
                </td>
        		<td width="200" style="font-size: 11px"> <?php echo $post['dd_note']; ?> </td>
        	</tr>
   <?php     }
    printf('</tbody>');
       } 
       ?>
    </table>

    <table cellspacing="0" class="bottom_text">
        <tbody>
            <tr>
                <td style="padding-left: 10px; padding-top:20px"> Prepared by:</td>
                <td style="padding-left: 10px; padding-top:20px"> Noted by:</td>
            </tr>
            <tr>
    			<td style="height: 30px;"> </td>
    			<td style="height: 30px;"> </td>
    		</tr> 
            <tr>
    			<td style="font-weight: bold; padding-left: 10px;"> <?php echo $this->session->userdata('staff_fname').' '.$this->session->userdata('staff_lname'); ?> </td>
    			<td style="font-weight: bold; padding-left: 10px;"> <u>_______________________</u> </td>
    		</tr>
            <tr>
    			<td style="font-size: 11px;  padding-left: 10px; padding-bottom:20px"> <?php echo $this->session->userdata('staff_position'); ?> </td>
    			<td style="font-size: 11px;  padding-left: 10px; padding-bottom:20px"> Division Head </td>
    		</tr>
        </tbody>
	</table>



			<table valign="top" cellspacing="0" width="800" style="table-layout: fixed; border: none;">
            	<tr><td colspan="3" height="10"> </td></tr>
            	<tr>
            		<td width="266" style="font-size: 8px; font-family: mono"> </td>
            		<td width="266" style="font-size: 8px; font-family: mono; text-align: center;"></td>
            		<td width="266" style="font-size: 8px; font-family: mono; text-align: right;"><?php echo $date_now; ?> / <?php echo ucwords( $this->session->userdata('staff_fname').' '.$this->session->userdata('staff_lname') ); ?></td>
            	</tr>
            </table>
    	
       <!-- ########## END: MAIN PANEL ########## -->
   </body>
</html>