<?php
   $html = '
                <table id="invoice" border="1" style="background: #fff;border-collapse: collapse;" cellspacing="0" width="100%">
                    
                    <tr>
                        <td width="45%">
                            <table id="tb" width="100%">
                                <tr><td>Patient Name : '.ucfirst($userData["username"]).' </td></tr>
                                <tr><td>Contact No  : '.$userData["mobile_no"].'</td></tr>
                                <tr><td>Date : <span>'.$_POST["fromDate"].'</span> &nbsp;to &nbsp;<span>'.$_POST["toDate"].'</span></td></tr>
                            </table>		
                        </td>	
                        
                    </tr>
                </table>';

                echo $html;
