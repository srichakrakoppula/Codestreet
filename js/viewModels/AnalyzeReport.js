/**
 * AnalyzeReport module
 */
define(['ojs/ojcore', 'knockout', 'jquery', 'ojs/ojknockout', 'ojs/ojselectcombobox',
    'ojs/ojtable', 'ojs/ojpagingcontrol', 'ojs/ojpagingtabledatasource',
    'ojs/ojarraytabledatasource'
], function (oj, ko, $) {
    /**
     * The view model for the main content view template
     */
    function AnalyzeReportContentViewModel() {
        var self = this;
        self.reportArray = ko.observableArray();
        self.datasource = new oj.ArrayTableDataSource(self.reportArray, {idAttribute: 'Id'});
        self.searchColumn = ko.observable("Name");
        self.pagingdatasource = new oj.PagingTableDataSource(self.datasource);
        this.keyword = ko.observableArray();
        this.tags = ko.observableArray([]);
        self.searchResults = ko.observableArray();
        
        self.currentRowListener = function (event,ui){
            //console.log(ui.value.rowKey);
            self.pagingdatasource.get(ui.value.rowKey).then(function (result){
                $('#editorContainer').show();
                window.location.href = "#editorContainer"
                if(ui.value !== null){
                    ace.edit("editor").setValue(result['data']['usr_solution']);
                }
            });
        };
        
        this.searchChangeHandler = function (context, ui) {
            if (ui.option === "value") {
                
                var filterObj = self.keyword();
                var filter;
                if(filterObj[0]!==undefined)
                    filter = filterObj[0].toLowerCase();
                else{
                    filter = "_"
                }
                $.post('getSearchResults.php',{searchColumn: self.searchColumn, searchKey: filter},
                    function(report){
                        self.reportArray([]);
                        var i;
                        for (i = 0; i < report.length; i++) {
                            console.log(report['name']);
                            var record = {
                                'Id': i,
                                'name': report[i]['name'],
                                'testname': report[i]['testname'],
                                'title': report[i]['title'],
                                'usr_solution': report[i]['usr_solution'],
                                'score': report[i]['score'],
                                'time': report[i]['time'],
                                'space': report[i]['space']
                            };
                            self.reportArray.push(record);
                        }
                        
                        //console.log(JSON.stringify(self.reportArray()));
                    },'json'
                );
            }
        };
        
        $(document).ready(function () {
            $.getJSON("fetch_report.php", function (report) {
                var i;
                for (i = 0; i < report.length; i++) {

                    var record = {
                        'Id': i,
                        'name': report[i]['name'],
                        'testname': report[i]['testname'],
                        'title': report[i]['title'],
                        'usr_solution': report[i]['usr_solution'],
                        'score': report[i]['score'],
                        'time': report[i]['time'],
                        'space': report[i]['space']
                    };
                    self.reportArray.push(record);
                }
            });
            var editor;
            editor = ace.edit("editor")
            editor.setOptions({
                readOnly: true
            })
            $('#editorContainer').hide();
            var editorContainer = $('#editorContainer');
            $('#editorContainer').remove();
            $('#container').append(editorContainer);
            
        });
    }
    return AnalyzeReportContentViewModel;
});

