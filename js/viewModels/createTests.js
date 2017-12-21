/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * createTests module
 */
define(['ojs/ojcore', 'knockout', 'jquery', 'ojs/ojknockout', 'ojs/ojinputtext' 
], function (oj, ko, $) {
    /**
     * The view model for the main content view template
     */
    function createTestsContentViewModel() {
        var self = this;
        self.testname = ko.observable();
        self.noOfQues = ko.observable();
        self.start_date = ko.observable();
        self.start_time = ko.observable();
        self.duration = ko.observable();
    }
    $(document).ready(
                
    );
    return createTestsContentViewModel;
});
