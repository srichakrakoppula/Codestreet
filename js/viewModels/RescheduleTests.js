/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * RescheduleTests module
 */
define(['ojs/ojcore', 'knockout', 'jquery', 'ojs/ojknockout','ojs/ojinputnumber','ojs/ojselectcombobox',
    'ojs/ojtable', 'ojs/ojpagingcontrol', 'ojs/ojpagingtabledatasource',
    'ojs/ojarraytabledatasource','ojs/ojdatetimepicker','ojs/ojtimezonedata', 'ojs/ojbutton'
], function (oj, ko, $) {
   
    function RescheduleTestsContentViewModel() {
        var self = this;
        self.reportArray = ko.observableArray();
        //[{testid:'1',testname:'Koderingan',no_of_ques:'2',start_date:'2016-12-13',start_time:'T12:00+00:00',duration:'120',active:'1'}]
        self.datasource = new oj.ArrayTableDataSource(self.reportArray, {idAttribute: 'testid'});
        $(document).ready(function(){ 
            $.getJSON("fetch_tests.php",function(report){
                var i;
                
                for(i=0;i<report.length;i++){
                    var record = {
                        'testid' : report[i]['testid'],
                        'testname' : report[i]['testname'],
                        'no_of_ques' : report[i]['no_of_ques'],
                        'start_date' : report[i]['start_date'],
                        'start_time' : report[i]['start_time'],
                        'duration' : report[i]['duration'],
                        'active' : report[i]['active']
                    };
                    self.reportArray.push(record);
                }
            });
        });
        self.updateTests = function(data, event){
            var report_new = new Array();
            
            event.preventDefault();
            //var temp = [1,2,3,4,5,6];
            self.reportArray().forEach(function(row,i){
                var row_data=[];
                //console.log(JSON.stringify(row['active'][0]));
                row_data[0] = row['testid'];
                row_data[1] = row['testname'];
                row_data[2] = row['start_date'];
                row_data[3] = row['start_time'];
                row_data[4] = row['duration'];
                row_data[5] = row['active'][0];
                report_new[i] = row_data;
            });
            //console.log("report_new: "+report_new[0]['testid']);
            $.ajax({ url: 'update_tests.php',
                data: {data : report_new},
                type: 'POST',
                complete: function(output) {
                    console.log("success_from_console"+output);
                    location.reload();
                }
            });            
            return true;
        };
        
    }
    return RescheduleTestsContentViewModel;
});
