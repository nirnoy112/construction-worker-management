$(function() {

    $('#dob').change(function() {

        var dob = $('#dob').val();

        if(dob) {

            //alert('DOB: ' + dob);
            var age = new Date(new Date() - new Date(dob)).getFullYear() - 1970;
            //alert('Age: ' + age);

            if(age < 18) {

                if(confirm('Worker is under 18 ( Age: ' + age + ' )! Do you want to continue with the DOB you\'ve entered?')) {

                    $('#dob').val(dob);

                } else {

                    $('#dob').val('');

                }

            }

        }

    });


    $('.single-searchable-select').select2();

    var loc = window.location.href;

    if(loc.search('worker/edit') > 0) {
        
        var dsSiteId = $('#dsSiteId').val();

        construction_sites.forEach(function(site) {
            
            if(dsSiteId == site.id) {

                if(site.ndttPanelId > 0) {

                    $('#isTT1').prop('checked', true);

                }

                var siteInformation = site.siteName + ' - ' + site.city + ', ' + site.state;

                $('#tt1Id').val(site.ndttPanelId);
                $('#tt1').val(site.ndttLotId);
                $('#tt1ExpDate').val(site.ndttExpDate);
                $('#collectionSite').val(siteInformation);

                $('.assigning-company-name').html(site.assigningCompanyName);
                $('.company-information').html(site.assigningCompanyName.toUpperCase());
                $('.site-information').html(siteInformation.toUpperCase());

            }

        });

        $('#dsSiteId').change(function() {

            var dsSiteId = $('#dsSiteId').val();

            construction_sites.forEach(function(site) {
                
                if(dsSiteId == site.id) {

                    if(site.ndttPanelId > 0) {

                        $('#isTT1').prop('checked', true);

                    }

                    var siteInformation = site.siteName + ' - ' + site.city + ', ' + site.state;

                    $('#tt1Id').val(site.ndttPanelId);
                    $('#tt1').val(site.ndttLotId);
                    $('#tt1ExpDate').val(site.ndttExpDate);
                    $('#collectionSite').val(siteInformation);

                    $('.assigning-company-name').html(site.assigningCompanyName);
                    $('.company-information').html(site.assigningCompanyName.toUpperCase());
                    $('.site-information').html(siteInformation.toUpperCase());

                }

            });

        });
        
    }


    $('#startTime').timepicker();

    $('#endTime').timepicker();

    $('#clockInModal').modal('hide');

    $('#clockOutModal').modal('hide');

    $('#clockOutModalOnLO').modal('show');

    $('#intime-section').css('display', 'none');

    $('#note-section').css('display', 'none');

    $('#pictureFile').change(function(e) {

        e.preventDefault();

        var chosenFile = $('#pictureFile').val();

        if(chosenFile !== undefined || chosenFile !== '' || chosenFile !== null) {

            $('#upload_image').prop('disabled', false);

        } else {

            $('#upload_image').prop('disabled', true);

        }

    });

    /*var siteInfo = $('#siteInfo').val();

    var siArr = siteInfo.split('/');

    $('#siteId').val(siArr[0]);

    $('#companyId').val(siArr[1]);

    var currentDate = new Date();

    $('#ci-current-time').html(currentDate.toLocaleTimeString());

    $('#time').val(currentDate.getTime());

    if(siArr[2] != 0 && siArr[2] != -1) {

        var currentTime = Math.ceil(currentDate.getTime() / 60000);

        var stDate = new Date(siArr[2]);

        $('#ci-due-time').html(stDate.toLocaleTimeString());

        var startTime = stDate.getTime();

        $('#dueTime').val(startTime);

        var stTime = Math.ceil(startTime / 60000);

         if(Math.abs(currentTime - stTime) < 8) {

            $('#intime-section').css('display', 'none');

            $('#note-section').css('display', 'none');

        }

        if(currentTime - stTime > 7) {

            var delay = currentTime - stTime;

            $('#intime-section').css('display', 'block');

            $('#intime-information'). html('You are ' + delay + ' minutes behind the time to start working! In this case, you are recommended to put a valid note below for your late clock in.')

            $('#note-section').css('display', 'block');
                
            $('#lateInTime').val(delay);

        }

        if(stTime - currentTime > 7) {

            var early = stTime - currentTime;

            $('#intime-section').css('display', 'block');

            $('#intime-information'). html('You are ' + early + ' minutes ahead the to to start working! In this case, you are recommended to put a valid note below for your early clock in.')

            $('#note-section').css('display', 'block');
                
            $('#earlyInTime').val(early);

        }

    } else {

        if(siArr[2] == 0) {

            $('#ci-due-time').html('Unset');

        } else {

            $('#ci-due-time').html('--:-- --');

        }

        $('#intime-section').css('display', 'none');

        $('#note-section').css('display', 'none');

    }*/

    $('#siteInfo').change(function(e) {

        var siteInfo = $(this).val();

        var siArr = siteInfo.split('/');

        $('#siteId').val(siArr[0]);

        $('#companyId').val(siArr[1]);

        var currentDate = new Date();

        $('#ci-current-time').html(currentDate.toLocaleTimeString("en-US", {timeZone: "America/New_York"}));

        $('#time').val(currentDate.getTime());

        if(siArr[2] != 0 && siArr[2] != -1) {

            var currentTime = Math.ceil(currentDate.getTime() / 60000) - 600;

            var stDate = new Date(siArr[2]);

            var startTime = stDate.getTime();

            $('#ci-due-time').html(stDate.toLocaleTimeString());

            $('#dueTime').val(startTime);

            var stTime = Math.ceil(startTime / 60000);

             if(Math.abs(currentTime - stTime) < 8) {

                $('#intime-section').css('display', 'none');

                $('#note-section').css('display', 'none');

            }

            if(currentTime - stTime > 7) {

                var delay = currentTime - stTime;

                $('#intime-section').css('display', 'block');

                $('#intime-information'). html('You are ' + delay + ' minutes behind the time to start working! In this case, you are recommended to put a valid note below for your late clock in.')

                $('#note-section').css('display', 'block');

                $('#lateInTime').val(delay);

            }

            if(stTime - currentTime > 7) {

                var early = stTime - currentTime;

                $('#intime-section').css('display', 'block');

                $('#intime-information'). html('You are ' + early + ' minutes ahead the time to start working! In this case, you are recommended to put a valid note below for your early clock in.')

                $('#note-section').css('display', 'block');
                
                $('#earlyInTime').val(early);

            }

        } else {

            if(siArr[2] == 0) {

                $('#ci-due-time').html('Unset');

            } else {

                $('#ci-due-time').html('--:-- --');

            }

            $('#intime-section').css('display', 'none');

            $('#note-section').css('display', 'none');

    }


    });

    $('#ohs-clock-out-link').click(function(e) {

        e.preventDefault();

        $('#clockOutModal').modal('show');

        var codTime = $('#ohs-co-due-time').val();

        var currTime = new Date();

        var currentT = currTime.getTime();

         $('#co-current-time').html(currTime.toLocaleTimeString("en-US", {timeZone: "America/New_York"}));

         $('#co-time').val(currentT);

        if(codTime != 0) {

            var coTime = new Date(codTime);
            
            var endT = coTime.getTime();

             $('#co-due-time').html(coTime.toLocaleTimeString());

            //alert(codTime);

            $('#co-dueTime').val(endT);

            

            var endTime = Math.ceil(endT / 60000);

            var currentTime = Math.ceil(currentT / 60000) - 600;
            //alert(currentTime + ' ' + endTime);

             if(Math.abs(currentTime - endTime) < 8) {

                $('#co-intime-section').css('display', 'none');

                $('#co-note-section').css('display', 'none');

            }

            if(endTime - currentTime > 7) {

                var early = endTime - currentTime;

                $('#co-intime-section').css('display', 'block');

                $('#co-intime-information'). html('You are ' + early + ' minutes ahead the time to stop working! In this case, you are recommended to put a valid note below for your late clock in.')

                $('#co-note-section').css('display', 'block');

                $('#co-earlyInTime').val(early);

            }

            if(currentTime - endTime > 7) {

                var delay = currentTime - endTime;

                $('#co-intime-section').css('display', 'block');

                $('#co-intime-information'). html('You are ' + delay + ' minutes behind the time to stop working! In this case, you are recommended to put a valid note below for your early clock in.')

                $('#co-note-section').css('display', 'block');
                
                $('#co-lateInTime').val(delay);

            }

        } else {


            $('#co-due-time').html('Unset');

            $('#co-intime-section').css('display', 'none');

            $('#co-note-section').css('display', 'none');
        }

    });

    $('#close_clock_out').click(function(e) {

        e.preventDefault();

        $('#clockOutModal').modal('hide');

    });

    $('#close_clock_in').click(function(e) {

        e.preventDefault();

        $('#clockInModal').modal('hide');

    });

    var loc = window.location.href;

    if(loc.search('time_clock') > 0) {

        var utId = $('#ohs-ur-id').html();
        var dstCollector = $('#ohs-dst-collector').html();
        var clockedIn = $('#ohs-clocked-in').html();

        if(utId == 2 && dstCollector == 0 && clockedIn == -1) {

            $('#clockInModal').modal('show');

        }

    }

    $('#clock_in_submit').click(function(e) {

        var tcUrl = $('#ohs-tc-url').val();

        var uId = $('#userId').val();
        var ciT = $('#time').val();
        var dueTime = $('#dueTime').val();
        var earlyIT = $('#earlyInTime').val();
        var lateIT = $('#lateInTime').val();
        var sId = $('#siteId').val();
        var cId = $('#companyId').val();
        var dTtime = $('#dueTime').val();
        var targetUrl = $('#target-url').val();

        var ciNote = '';

        if(earlyIT > 0 || lateIT > 0) {

            ciNote = $('textarea#note').val();
            

        }

        var requestJson = {userId: uId, siteId: sId, companyId: cId, dueTime: dTtime, time: ciT, earlyInTime: earlyIT, lateInTime: lateIT, activity: 'Clock In', note: ciNote};

        $.post(tcUrl, requestJson, function(data, status){

            var response = JSON.parse(data);

            if(response.result > 0) {

                window.location = targetUrl;

            } else {

                

            }

        });

    });

    
    var location = window.location.href;

    var utId = $('#ohs-ur-id').html();

    if(utId == 2) {

        var clockedIn = $('#ohs-clocked-in').html();
        console.log(clockedIn);
        $('#clock-in-out-heading').css('display', 'block');
        $('#break-in-out-heading').css('display', 'block');

        if(clockedIn == 1) {

            $('#clock-in-option').css('display', 'none');
            $('#clock-out-option').css('display', 'block');
            $('#break-in-out-option').css('display', 'none');

            var breakedIn = $('#ohs-breaked-in').html();

            if(breakedIn == 1) {

                $('#break-in-option').css('display', 'none');
                $('#break-out-option').css('display', 'block');

            } else {

                $('#break-out-option').css('display', 'none');
                $('#break-in-option').css('display', 'block');

            }

        } else {

            $('#clock-out-option').css('display', 'none');
            $('#clock-in-option').css('display', 'block');

            $('#break-in-option').css('display', 'none');
            $('#break-out-option').css('display', 'none');

            $('#break-in-out-option').css('display', 'block');

        }

    } else {

        $('#clock-in-option').css('display', 'none');
        $('#clock-out-option').css('display', 'none');

        $('#break-in-option').css('display', 'none');
        $('#break-out-option').css('display', 'none');
        $('#break-in-out-option').css('display', 'none');

        $('#clock-in-out-heading').css('display', 'none');
        $('#break-in-out-heading').css('display', 'none');

    }

    $('#ohs-clock-in-link').click(function(e) {

        e.preventDefault();

        $('#clockInModal').modal('show');
        
        /*var uId = $('#ohs-u-id').html();
        var utId = $('#ohs-ur-id').html();
        var dstCollector = $('#ohs-dst-collector').html();
        var clockedIn = $('#ohs-clocked-in').html();
        var tcUrl = $('#ohs-tc-url').html();

        var currentDate = new Date();

        var currentTime = currentDate.getTime();

        var requestJson = {userId: uId, time: currentTime, activity: 'Clock In', note: null};

        $.post(tcUrl, requestJson, function(data, status) {

            var response = JSON.parse(data);

            if(response.result > 0) {

                //window.location.reload();

            } else {

                

            }

        });*/

    });

    $('#clock_out_submit').click(function(e) {
        
        var tcOutUrl = $('#co-target-url').val();
        var tcUrl = $('#co-ohs-tc-url').val();

        var currentDate = new Date();

        var currentTime = currentDate.getTime();

        var ciNote = '';

        if($('#co-earlyInTime').val() > 0 || $('#co-lateInTime').val() > 0) {

            ciNote = $('textarea#co-note').val();
            

        }

        var requestJson = {time: $('#co-time').val(), dueTime: $('#co-dueTime').val(), earlyInTime: $('#co-earlyInTime').val(), lateInTime: $('#co-lateInTime').val(), activity: 'Clock Out', note: $('#co-note').val()};

        console.log(requestJson);

        $.post(tcUrl, requestJson, function(data, status) {

            var response = JSON.parse(data);

            console.log(response);

            if(response.result > 0) {

                window.location = tcOutUrl;

            } else {

                

            }

        });

    });


    $('#ohs-break-in-link').click(function(e) {

        var tcUrl = $('#tc-url').html();

        var currentDate = new Date();

        var currentTime = currentDate.getTime();

        var requestJson = {time: currentTime, activity: 'Break In'};

        $.post(tcUrl, requestJson, function(data, status) {

            var response = JSON.parse(data);

            if(response.result > 0) {

                //window.location.reload();

            } else {

                

            }

        });

    });

    $('#ohs-break-out-link').click(function(e) {

        var tcUrl = $('#tc-url').html();

        var currentDate = new Date();

        var currentTime = currentDate.getTime();

        var requestJson = {time: currentTime, activity: 'Break Out'};

        $.post(tcUrl, requestJson, function(data, status) {

            var response = JSON.parse(data);

            if(response.result > 0) {

                //window.location.reload();

            } else {

                

            }

        });

    });

    var dstCollector = $('#ohs-dst-collector').html();

    if(dstCollector == 1) {

        $('#log-dtc-heading').css('display', 'block');
        $('#log-new-dtc').css('display', 'block');
        
    }
    
    var wSex = $('input[type=radio][name=sex]').val();

    if(wSex == 'Female') {

        $('#worker-minority').css('display', 'none');
        $('#worker-minority-female').css('display', 'block');
        $('#worker-minority-type').css('display', 'none');
        $('#worker-minority-type-female').css('display', 'block');

    } else {

        $('#worker-minority-type').css('display', 'block');
        $('#worker-minority-type-female').css('display', 'none');
        $('#worker-minority').css('display', 'block');
        $('#worker-minority-female').css('display', 'none');

    }
    
    
    $('input[type=radio][name=sex]').on('change', function() {

        switch($(this).val()) {

            case 'Female':

                $('#worker-minority').css('display', 'none');
                $('#worker-minority-female').css('display', 'block');
                $('#worker-minority-type').css('display', 'none');
                $('#worker-minority-type-female').css('display', 'block');
                break;

        case 'Male':

            $('#worker-minority').css('display', 'block');
            $('#worker-minority-female').css('display', 'none');
            $('#worker-minority-type').css('display', 'block');
            $('#worker-minority-type-female').css('display', 'none');
            break;

        }

    });

    /*var setForm = function() {

        $(':input').each(function() {

            $(this).data('initialValue', $(this).val());

        });
    }*/

    var confirmLeave = function() {

        //alert('called');

        var isModified = false;

        /*$(':input').each(function() {
            if($(this).data('initialValue') != $(this).val()) {
                    isModified = true;
            }
        });*/

        $(':input').change(function() {

            isModified = true;

        });

        

        $('a').click(function(e) {
            
            if(isModified == true) {

                if(confirm('Are you sure that you want to leave this page without saving the changes?')) {

                
                    //var targetLocation = $(this).prop('href');
                    //console.log(targetLocation);

                } else {

                    e.preventDefault();

                }
            }

        });

        

    };

    var getRadioButtonValue = function(radioButtons) {

        for(var i=0; i< radioButtons.length; i++) {

            var button = radioButtons[i];

            if(button.checked) {
                return button.value;
            }
        }

    };

    $('#drug_screening_submit').click(function(e) {

        var name = document.forms['ds-form']['workerName'].value;
        var identificationType = document.forms['ds-form']['identificationType'].value;
        var identificationId = document.forms['ds-form']['identificationId'].value;
        var subcontractorId = document.forms['ds-form']['subcontractorId'].value;
        var employerNotInList = document.forms['ds-form']['employerNotInList'].value;
        var otherEmployerName = document.forms['ds-form']['otherEmployerName'].value;
        var reason = document.forms['ds-form']['reason'].value;
        var tt1 = document.forms['ds-form']['isTT1'].value;
        var tt2 = document.forms['ds-form']['isTT2'].value;

        var reasonControls = document.forms['ds-form'].reason;

        var reasonValue = getRadioButtonValue(reasonControls);
        //console.log(reasonValue);

        var resultControls = document.forms['ds-form'].testResult;

        var resultValue = getRadioButtonValue(resultControls);
        //console.log(resultValue);

        var testType = null;

        if(tt1 == 'YES' || tt2 == 'YES') {

            testType = 1;

        }

        var company = null;

        if(subcontractorId != 0 || otherEmployerName) {

            company = 1;

        }


        var testResult = document.forms['ds-form']['testResult'].value;
        var collectionDate = document.forms['ds-form']['collectionDate'].value;
        var collector = document.forms['ds-form']['collector'].value;

        if(!name || !identificationType || !identificationId || !company || reasonValue == undefined || !testType || resultValue == undefined || !collectionDate || !collector) {

            e.preventDefault();
        }

        $('#ds-workerName').html('');
        $('#ds-identificationType').html('');
        $('#ds-identificationId').html('');
        $('#ds-subcontractorId').html('');
        $('#ds-reason').html('');
        $('#ds-testType').html('');
        $('#ds-testResult').html('');
        $('#ds-collectionDate').html('');
        $('#ds-collector').html('');

        if(!name) {
            $('#ds-workerName').html('Name of Worker is required.');
        }

        if(!identificationType) {
            $('#ds-identificationType').html('Identification Type is required.');
        }

        if(!identificationId) {
            $('#ds-identificationId').html('Identification ID is required.');
        }

        if(!company) {
            $('#ds-subcontractorId').html('Employer is required.');
        }

        if(reasonValue == undefined) {
            $('#ds-reason').html('Reason for Test is required.');
        }

        if(!testType) {
            $('#ds-testType').html('Test Type is required.');
        }

        if(resultValue == undefined) {
            $('#ds-testResult').html('Test Result is required.');
        }

        if(!collectionDate) {
            $('#ds-collectionDate').html('Collection Date is required.');
        }

        if(!collector) {
            $('#ds-collector').html('Name of Collector is required.');
        }

    });

    $('#ds_edition_submit').click(function(e) {

        var name = document.forms['ds-form']['workerName'].value;
        var identificationType = document.forms['ds-form']['identificationType'].value;
        var identificationId = document.forms['ds-form']['identificationId'].value;
        var subcontractorId = document.forms['ds-form']['subcontractorId'].value;
        var employerNotInList = document.forms['ds-form']['employerNotInList'].value;
        var otherEmployerName = document.forms['ds-form']['otherEmployerName'].value;
        var reason = document.forms['ds-form']['reason'].value;
        var tt1 = document.forms['ds-form']['isTT1'].value;
        var tt2 = document.forms['ds-form']['isTT2'].value;

        var testType = 0;

        if(tt1 == 'YES' || tt2 == 'YES') {

            testType = 1;

        }

        var company = null;

        if(subcontractorId != 0 || otherEmployerName) {

            company = 1;

        }


        var testResult = document.forms['ds-form']['testResult'].value;
        var collectionDate = document.forms['ds-form']['collectionDate'].value;
        var collector = document.forms['ds-form']['collector'].value;

        if(!name || !identificationType || !identificationId || !company || !reason || !testType || !testResult || !collectionDate || !collector) {

            e.preventDefault();
        }

        $('#ds-workerName').html('');
        $('#ds-identificationType').html('');
        $('#ds-identificationId').html('');
        $('#ds-subcontractorId').html('');
        $('#ds-reason').html('');
        $('#ds-testType').html('');
        $('#ds-testResult').html('');
        $('#ds-collectionDate').html('');
        $('#ds-collector').html('');

        if(!name) {
            $('#ds-workerName').html('Name of Worker is required.');
        }

        if(!identificationType) {
            $('#ds-identificationType').html('Identification Type is required.');
        }

        if(!identificationId) {
            $('#ds-identificationId').html('Identification ID is required.');
        }

        if(!company) {
            $('#ds-subcontractorId').html('Employer is required.');
        }

        if(!reason) {
            $('#ds-reason').html('Reason for Test is required.');
        }

        if(testType == 0) {
            $('#ds-testType').html('Test Type is required.');
        }

        if(!testResult) {
            $('#ds-testResult').html('Test Result is required.');
        }

        if(!collectionDate) {
            $('#ds-collectionDate').html('Collection Date is required.');
        }

        if(!collector) {
            $('#ds-collector').html('Name of Collector is required.');
        }
    });

    $("#alertModal").modal('hide');

    $('#register_worker').click(function(e) {

        var apiUrl = $("#wv_url").val();
        //alert(apiUrl);

        e.preventDefault();

        var fName = $("#firstName").val();
        var lName = $("#lastName").val();
        var db = $("#dob").val();

        var requestJson = {firstName: fName, lastName: lName, dob: db};

        $.post(apiUrl, requestJson, function(data, status){

            var response = JSON.parse(data);

            if(response.result > 0) {

                if(confirm('The worker you want to register already exists. Press OK to view the existing worker.')) {

                    window.location.href = response.workerAnchor;

                } else {

                    

                }

                //$("#alertModal").modal('show');

                //$('#existing-worker-link').html('<a href="' + response.workerAnchor + '">VEIW EXISTING WORKER</a');

                

                //e.preventDefault();

                //alert('The worker you want to register already exists.<br><a href="' + response.workerAnchor + '">VEIW EXISTING WORKER</a>');

            } else {

                var companyId = document.forms['rw-form']['companyId'].value;
                var companyNotInList = document.forms['rw-form']['companyNotInList'].checked;
                var otherCompanyName = document.forms['rw-form']['otherCompanyName'].value;

                var company = null;

                $('#rw-otherCompanyName').html('');
                $('#rw-companyId').html('');

                if(companyId != 0 || otherCompanyName) {

                    company = 1;

                }

                var siteIdW = document.forms['rw-form']['siteIdW'].value;
                var siteNotInList = document.forms['rw-form']['siteNotInList'].checked;
                var otherSiteName = document.forms['rw-form']['otherSiteName'].value;

                var site = null;

                $('#rw-otherSiteName').html('');
                $('#rw-siteIdW').html('');

                if(siteIdW != 0 || otherSiteName) {

                    site = 1;

                }
                //console.log(companyId + ' ' + companyNotInList + ' ' + otherCompanyName);
                
                if(company && site) {

                    $('#rwForm').submit();

                } else {

                    if(!company) {

                        if(companyNotInList) {
                            $('#companyNotInList').prop('checked', true);
                            $('#rw-otherCompanyName').html('Other Company Name is required.');
                        } else {
                            $('#companyNotInList').prop('checked', false);
                            $('#rw-companyId').html('Company is required.');
                        }

                    }

                    if(!site) {

                        if(siteNotInList) {
                            $('#siteNotInList').prop('checked', true);
                            $('#rw-otherSiteName').html('Other Site Name is required.');
                        } else {
                            $('#siteNotInList').prop('checked', false);
                            $('#rw-siteIdW').html('Site is required.');
                        }

                    }
                    

                }

            }

        });

    
    });

    $('#worker_edit').click(function(e) {
        
        var companyId = document.forms['ew-form']['companyId'].value;
        var companyNotInList = document.forms['ew-form']['companyNotInList'].checked;
        var otherCompanyName = document.forms['ew-form']['otherCompanyName'].value;

        var company = null;

        $('#ew-otherCompanyName').html('');
        $('#ew-companyId').html('');

        if(companyId != 0 || otherCompanyName) {

            company = 1;

        }

        var siteIdW = document.forms['ew-form']['siteIdW'].value;
        var siteNotInList = document.forms['ew-form']['siteNotInList'].checked;
        var otherSiteName = document.forms['ew-form']['otherSiteName'].value;

        var site = null;

        $('#ew-otherSiteName').html('');
        $('#ew-siteIdW').html('');

        if(siteIdW != 0 || otherSiteName) {

            site = 1;

        }
        //console.log(companyId + ' ' + companyNotInList + ' ' + otherCompanyName);
        
        if(company && site) {

            $('#ewForm').submit();

        } else {

            e.preventDefault();

            if(!company) {

                if(companyNotInList) {
                    $('#companyNotInList').prop('checked', true);
                    $('#ew-otherCompanyName').html('Other Company Name is required.');
                } else {
                    $('#companyNotInList').prop('checked', false);
                    $('#ew-companyId').html('Company is required.');
                }

            }

            if(!site) {

                if(siteNotInList) {
                    $('#siteNotInList').prop('checked', true);
                    $('#ew-otherSiteName').html('Other Site Name is required.');
                } else {
                    $('#siteNotInList').prop('checked', false);
                    $('#ew-siteIdW').html('Site is required.');
                }

            }
            

        }

    });

    var isOtherComDs = $('#employerNotInList').prop('checked');
    //console.log(isOtherCom);

    if(isOtherComDs) {

        $('#other-com-ds').css('display', 'block');

    } else {

        $('#other-com-ds').css('display', 'none');

    }

    $('#employerNotInList').change(function(e) {

        var value = $(this).prop('checked');
        //console.log(value);

        //alert(value);

        if(value) {

            $('#other-com-ds').css('display', 'block');

        } else {

            $('#other-com-ds').css('display', 'none');

        }

    });

    var isOtherCom = $('#companyNotInList').prop('checked');
    //console.log(isOtherCom);

    if(isOtherCom) {

        $('#other-com').css('display', 'block');

    } else {

        $('#other-com').css('display', 'none');

    }

    $('#companyNotInList').change(function(e) {

        var value = $(this).prop('checked');
        //console.log(value);

        //alert(value);

        if(value) {

            $('#other-com').css('display', 'block');

        } else {

            $('#other-com').css('display', 'none');

        }

    });

    var isOtherSite = $('#siteNotInList').prop('checked');
    //console.log(isOtherCom);

    if(isOtherSite) {

        $('#other-site').css('display', 'block');

    } else {

        $('#other-site').css('display', 'none');

    }

    $('#siteNotInList').change(function(e) {

        var value = $(this).prop('checked');
        //console.log(value);

        //alert(value);

        if(value) {

            $('#other-site').css('display', 'block');

        } else {

            $('#other-site').css('display', 'none');

        }

    });

    var isOtherSiteDS = $('#ds-siteNotInList').prop('checked');
    //console.log(isOtherCom);

    if(isOtherSiteDS) {

        $('#ds-other-site').css('display', 'block');

    } else {

        $('#ds-other-site').css('display', 'none');

    }

    $('#ds-siteNotInList').change(function(e) {

        var value = $(this).prop('checked');
        //console.log(value);

        //alert(value);

        if(value) {

            $('#ds-other-site').css('display', 'block');

        } else {

            $('#ds-other-site').css('display', 'none');

        }

    });


    /*$('#cancel_alert').click(function(e) {

        e.preventDefault();
        
        $("#alertModal").modal('hide');

    });*/

    $("#siteModal").modal('show');

    $('#cancel_assign').click(function(e) {

        e.preventDefault();
        
        $("#siteModal").modal('hide');

    });

    $("#viewWorkerModal").modal('hide');

    $('.view_worker').click(function(e) {

        e.preventDefault();

        var url = $(this).val();
        
        $.get(url, function(data, status){

            var response = JSON.parse(data);
            console.log(response.worker);

            if(response.result > 0) {

                var worker = response.worker;
        
                $("#viewWorkerModal").modal('show');

                $('#workerName').html(worker.lastName + ' ' + worker.firstName + ' ' + worker.middleName);
                if(worker.imageURI) {
                    $('#wImg').prop('src', worker.imageURI);
                }


                $('#status').html(worker.status);
                $('#sex').html(worker.sex);
                $('#dob').html(worker.dob);
                $('#primaryPhone').html(worker.primaryPhone);
                $('#email').html(worker.email);
                $('#address1').html(worker.address1);
                $('#address2').html(worker.address2);
                $('#comm_pref').html(worker.comm_pref);
                $('#city').html(worker.city);
                $('#state').html(worker.state);
                $('#zipCode').html(worker.zipCode);
                $('#jobTitle').html(worker.jobTitle);
                $('#otherTrade').html(worker.otherTrade);
                $('#identificationType').html(worker.identificationType);
                $('#otherIdType').html(worker.otherIdType);
                $('#identificationId').html(worker.identificationId);
                $('#jobs').html(worker.jobs);
                $('#siteName').html(worker.siteName);
                $('#companyName').html(worker.companyName);
                /*$('#cs').html(worker.cs);
                $('#ss').html(worker.ss);
                $('#scs').html(worker.scs);*/

                $('#ecName').html(worker.ecName);
                $('#ecRelationship').html(worker.ecRelationship);
                $('#ecPhone').html(worker.ecPhone);
                $('#ecAltPhone').html(worker.ecAltPhone);

            } else {

                

            }

        });

    });

    $('#close_worker_view').click(function(e) {

        e.preventDefault();
        
        $("#viewWorkerModal").modal('hide');

    });

    $("#certsModal").modal('show');

    $('#cancel_certs').click(function(e) {

        e.preventDefault();
        
        $("#certsModal").modal('hide');

    });

    $("#certModal").modal('hide');

    $('#cert_add').click(function(e) {

        e.preventDefault();
        
        $("#certModal").modal('show');

    });

    $('#cancel_cert').click(function(e) {

        e.preventDefault();
        
        $("#certModal").modal('hide');

    });

    $("#rcExaminationModal").modal('show');

    $('#cancel_rc_exam').click(function(e) {

        e.preventDefault();
        
        $("#rcExaminationModal").modal('hide');

    });

    $("#viewDsModal").modal('show');

    $('#close_ds_view').click(function(e) {

        e.preventDefault();
        
        $("#viewDsModal").modal('hide');

    });

    $("#drugScreeningModal").modal('show');

    $('#cancel_drug_screening').click(function(e) {

        e.preventDefault();
        
        $("#drugScreeningModal").modal('hide');

    });

    $("#alcoholTestModal").modal('show');

    $('#cancel_at_modal').click(function(e) {

        e.preventDefault();
        
        $("#alcoholTestModal").modal('hide');

    });

    $("#viewAtModal").modal('show');

    $('#close_at_view').click(function(e) {

        e.preventDefault();
        
        $("#viewAtModal").modal('hide');

    });
    

    $("#nonOhsDrugScreeningModal").modal('show');

    $('#cancel_non_ohs_ds').click(function(e) {

        e.preventDefault();
        
        $("#nonOhsDrugScreeningModal").modal('hide');

    });

    
    $("#viewInventoryOrderModal").modal('show');

    $('#close_io_view').click(function(e) {

        e.preventDefault();
        
        $("#viewInventoryOrderModal").modal('hide');

    });

    
    $("#addSupplyOrderModal").modal('show');

    $('#cancel_supply_order').click(function(e) {

        e.preventDefault();
        
        $("#addSupplyOrderModal").modal('hide');

    });

    
    $("#editSupplyOrderModal").modal('show');

    $('#cancel_io_edit').click(function(e) {

        e.preventDefault();
        
        $("#editSupplyOrderModal").modal('hide');

    });

    $("#sendingOrderEmail").modal('hide');

    $('.send_inventory_order').click(function(e) {

        e.preventDefault();
        
        $("#sendingOrderEmail").modal('show');

        var sioId = $(this).val();

        $("#sioId").val(sioId);

    });

    $('#close_send').click(function(e) {

        e.preventDefault();
        
        $("#sendingOrderEmail").modal('hide');

    });

    $("#downloadingOrdersModal").modal('hide');

    $('#download_orders').click(function(e) {

        e.preventDefault();
        
        $("#downloadingOrdersModal").modal('show');

    });

    $('#close_download').click(function(e) {

        e.preventDefault();
        
        $("#downloadingOrdersModal").modal('hide');

    });


    $("#addIncidentModal").modal('show');

    $('#cancel_add_incident').click(function(e) {

        e.preventDefault();
        
        $("#addIncidentModal").modal('hide');

    });

    
    $("#editIncidentModal").modal('show');

    $('#cancel_update_incident').click(function(e) {

        e.preventDefault();
        
        $("#editIncidentModal").modal('hide');

    });

    var incidentType = $('#in-type').val();

    if(incidentType == 'VACCINATION') {
        
        $('#fa-opts').css('display', 'none');
        $('#v-opts').css('display', 'block');

    } else {
        
        $('#v-opts').css('display', 'none');
        $('#fa-opts').css('display', 'block');

    }

    $('#in-type').change(function() {

        var incidentType = $(this).val();

        if(incidentType == 'VACCINATION') {
        
            $('#fa-opts').css('display', 'none');
            $('#v-opts').css('display', 'block');

        } else {
            
            $('#v-opts').css('display', 'none');
            $('#fa-opts').css('display', 'block');

        }

    });

    $('#site-id').change(function() {

        var siteDetails = $(this).val();

        if(siteDetails) {

            var siteData = siteDetails.split('|');

            $('#msLocation').val(siteData[1]);
            $('#msAddressLine1').val(siteData[2]);
            $('#msAddressLine2').val(siteData[3]);

        }

    });

    /*var eincidentType = $('#edit-in-type').val();

    if(eincidentType == 'VACCINATION') {
        
        $('#edit-fa-opts').css('display', 'none');
        $('#edit-v-opts').css('display', 'block');

    } else {
        
        $('#edit-v-opts').css('display', 'none');
        $('#edit-fa-opts').css('display', 'block');

    }

    $('#edit-in-type').change(function() {

        var incidentType = $(this).val();

        if(incidentType == 'VACCINATION') {
        
            $('#edit-fa-opts').css('display', 'none');
            $('#edit-v-opts').css('display', 'block');

        } else {
            
            $('#edit-v-opts').css('display', 'none');
            $('#edit-fa-opts').css('display', 'block');

        }

    });

    $('#edit-site-id').change(function() {

        var siteDetails = $(this).val();

        if(siteDetails) {

            var siteData = siteDetails.split('|');

            $('#edit-msLocation').val(siteData[1]);
            $('#edit-msAddressLine1').val(siteData[2]);
            $('#edit-msAddressLine2').val(siteData[3]);

        }

    });*/


    /****
    *
    *   Drug Screening Modal
    *
    ****/

    var isNegativeResult = $('#ds-negative-result').prop('checked');
    //alert(isInclusiveResult);

    if(isNegativeResult == true) {

        $('#inconclusive-div').css('display', 'none');

    }

    $('#ds-negative-result').change(function() {

        var isNegativeResult = $(this).prop('checked');
        //alert(isInclusiveResult);

        if(isNegativeResult == true) {

            $('#inconclusive-div').css('display', 'none');

        }
        
    });

    var isRefusedToTestResult = $('#ds-refused-to-test-result').prop('checked');
    //alert(isInclusiveResult);

    if(isRefusedToTestResult == true) {

        $('#inconclusive-div').css('display', 'none');

    }

    $('#ds-refused-to-test-result').change(function() {

        var isRefusedToTestResult = $(this).prop('checked');
        //alert(isInclusiveResult);

        if(isRefusedToTestResult == true) {

            $('#inconclusive-div').css('display', 'none');

        }
        
    });

    var isInclusiveResult = $('#ds-inconclusive-result').prop('checked');
    //alert(isInclusiveResult);

    if(isInclusiveResult == true) {

        $('#inconclusive-div').css('display', 'block');

        $('#test-details').html('Inconclusive Details');

        $('#inconclusiveDetails').html('');

    }

    $('#ds-inconclusive-result').change(function() {

        var isInclusiveResult = $(this).prop('checked');
        //alert(isInclusiveResult);

        if(isInclusiveResult == true) {

            $('#inconclusive-div').css('display', 'block');

            $('#test-details').html('Inconclusive Details');

            $('#inconclusiveDetails').html('');

        }

    });

    var isClearedResult = $('#ds-cleared-result').prop('checked');
    //alert(isInclusiveResult);

    if(isClearedResult == true) {

        $('#inconclusive-div').css('display', 'block');

        $('#test-details').html('Test Details');

        $('#inconclusiveDetails').html('Cleared in LAB on ' + $('#currentDate').val() + ' by ' + $('#loggedInUser').val() + '.');

    }

    $('#ds-cleared-result').change(function() {

        var isClearedResult = $(this).prop('checked');
        //alert(isInclusiveResult);

        if(isClearedResult == true) {

            $('#inconclusive-div').css('display', 'block');

            $('#test-details').html('Test Details');

            $('#inconclusiveDetails').html('Cleared in LAB on ' + $('#currentDate').val() + ' by ' + $('#loggedInUser').val() + '.');

        }

    });

    var isFarResult = $('#ds-far-result').prop('checked');
    //alert(isInclusiveResult);

    if(isFarResult == true) {

        $('#inconclusive-div').css('display', 'block');

        $('#test-details').html('Test Details');

        $('#inconclusiveDetails').html('Contact OHSTC For Further Information.');

    }

    $('#ds-far-result').change(function() {

        var isFarResult = $(this).prop('checked');
        //alert(isInclusiveResult);

        if(isFarResult == true) {

            $('#inconclusive-div').css('display', 'block');

            $('#test-details').html('Test Details');

            $('#inconclusiveDetails').html('Contact OHSTC For Further Information.');

        }

    });


    /****
    *
    *   Alcohol Test Modal
    *
    ****/

    var isNegativeResult = $('#at-negative-result').prop('checked');
    //alert(isInclusiveResult);

    if(isNegativeResult == true) {

        $('#at-inconclusive-div').css('display', 'none');

    }

    $('#at-negative-result').change(function() {

        var isNegativeResult = $(this).prop('checked');
        //alert(isInclusiveResult);

        if(isNegativeResult == true) {

            $('#at-inconclusive-div').css('display', 'none');

        }
        
    });

    var isRefusedToTestResult = $('#at-refused-to-test-result').prop('checked');
    //alert(isInclusiveResult);

    if(isRefusedToTestResult == true) {

        $('#at-inconclusive-div').css('display', 'none');

    }

    $('#at-refused-to-test-result').change(function() {

        var isRefusedToTestResult = $(this).prop('checked');
        //alert(isInclusiveResult);

        if(isRefusedToTestResult == true) {

            $('#at-inconclusive-div').css('display', 'none');

        }
        
    });

    var isInclusiveResult = $('#at-inconclusive-result').prop('checked');
    //alert(isInclusiveResult);

    if(isInclusiveResult == true) {

        $('#at-inconclusive-div').css('display', 'block');

        $('#at-test-details').html('Inconclusive Details');

        //$('#at-inconclusiveDetails').html('');

    }

    $('#at-inconclusive-result').change(function() {

        var isInclusiveResult = $(this).prop('checked');
        //alert(isInclusiveResult);

        if(isInclusiveResult == true) {

            $('#at-inconclusive-div').css('display', 'block');

            $('#at-test-details').html('Inconclusive Details');

            //$('#at-inconclusiveDetails').html('');

        }

    });

    var isAlcoholNegativeResult = $('#at-alcohol-negative').prop('checked');
    //alert(isInclusiveResult);

    if(isAlcoholNegativeResult == true) {

        $('#at-inconclusive-div').css('display', 'block');

        $('#at-test-details').html('Test Details');

        //$('#at-inconclusiveDetails').html('');

    }

    $('#at-alcohol-negative').change(function() {

        var isAlcoholNegativeResult = $(this).prop('checked');
        //alert(isInclusiveResult);

        if(isAlcoholNegativeResult == true) {

            $('#at-inconclusive-div').css('display', 'block');

            $('#at-test-details').html('Test Details');

            //$('#at-inconclusiveDetails').html('');

        }

    });

    var isPositiveResult = $('#at-positive').prop('checked');
    //alert(isInclusiveResult);

    if(isPositiveResult == true) {

        $('#at-inconclusive-div').css('display', 'block');

        $('#at-test-details').html('Test Details');

        //$('#at-inconclusiveDetails').html('');

    }

    $('#at-positive').change(function() {

        var isPositiveResult = $(this).prop('checked');
        //alert(isInclusiveResult);

        if(isPositiveResult == true) {

            $('#at-inconclusive-div').css('display', 'block');

            $('#at-test-details').html('Test Details');

            //$('#at-inconclusiveDetails').html('');

        }

    });

    var identificationType = $('#ds-id-type').val();

    if(identificationType == 'OTHER') {
        
        $('#otherIdType').prop('disabled', false);

    } else {
        
        $('#otherIdType').val('');
        $('#otherIdType').prop('disabled', true);

    }

    $('#ds-id-type').change(function() {

        var identificationType = $(this).val();

        if(identificationType == 'OTHER') {
            
            $('#otherIdType').prop('disabled', false);

        } else {
            
            $('#otherIdType').val('');
            $('#otherIdType').prop('disabled', true);

        }

    });

    var workerTrade = $('#worker-trade').val();

    if(workerTrade == 'OTHER') {
        
        $('#otherTrade').prop('disabled', false);

    } else {
        
        $('#otherTrade').val('');
        $('#otherTrade').prop('disabled', true);

    }

    $('#worker-trade').change(function() {

        var workerTrade = $(this).val();

        if(workerTrade == 'OTHER') {
            
            $('#otherTrade').prop('disabled', false);

        } else {
            
            $('#otherTrade').val('');
            $('#otherTrade').prop('disabled', true);

        }

    });

    var workerJobRole = $('worker-job-role').val();

    if(workerJobRole == 'OTHER') {
        
        $('#otherJobRole').prop('disabled', false);

    } else {
        
        $('#otherJobRole').val('');
        $('#otherJobRole').prop('disabled', true);

    }

    $('#worker-job-role').change(function() {

        var workerJobRole = $(this).val();

        if(workerJobRole == 'OTHER') {
            
            $('#otherJobRole').prop('disabled', false);

        } else {
            
            $('#otherJobRole').val('');
            $('#otherJobRole').prop('disabled', true);

        }

    });

    /*var workerMinority = $('worker-minority').val();

    if(workerMinority == 1) {
        
        $('#worker-minority-type').prop('disabled', false);

    } else {
        
        $('#worker-minority-type').val('NONE');
        $('#worker-minority-type').prop('disabled', true);

    }

    $('#worker-minority').change(function() {

        var workerMinority = $(this).val();

        if(workerMinority == 1) {
            
            $('#worker-minority-type').prop('disabled', false);

        } else {
            
            $('#worker-minority-type').val('NONE');
            $('#worker-minority-type').prop('disabled', true);

        }

    });*/

    /*var sexControls = document.forms['rw-form'].sex;

    var sex = getRadioButtonValue(sexControls);

    if(sex == 'Female') {
        alert('hh');
    }



    var eSexControls = document.forms['ew-form'].sex;

    var eSex = getRadioButtonValue(eSexControls);

    if(eSex == 'Female') {
        alert('hh');
    }*/


    var wIdentificationType = $('#w-id-type').val();

    if(wIdentificationType == 'OTHER') {
        
        $('#w-otherIdType').prop('disabled', false);

    } else {
        
        $('#w-otherIdType').val('');
        $('#w-otherIdType').prop('disabled', true);

    }

    $('#w-id-type').change(function() {

        var identificationType = $(this).val();

        if(identificationType == 'OTHER') {
            
            $('#w-otherIdType').prop('disabled', false);

        } else {
            
            $('#w-otherIdType').val('');
            $('#w-otherIdType').prop('disabled', true);

        }

    });


    var companyType = $('#ohs-ctid').val();

    if(companyType == 2) {

        //$('#ohs-pcid').val(0);
        
        $('#ohs-pcid').prop('disabled', true);

        //$('#ohs-btsid').val(0);

        $('#ohs-btsid').prop('disabled', true);

    } else {

        //$('#ohs-pcid').val(0);
        
        $('#ohs-pcid').prop('disabled', false);

        $('#ohs-btsid').prop('disabled', false);

    }


    $('#ohs-ctid').change(function() {

        var ctid = $(this).val();

        if(ctid == 2) {

            //$('#ohs-pcid').val(0);
            
            $('#ohs-pcid').prop('disabled', true);

            //$('#ohs-btsid').val(0);

            $('#ohs-btsid').prop('disabled', true);

        } else {

            //$('#ohs-pcid').val(0);
            
            $('#ohs-pcid').prop('disabled', false);

            $('#ohs-btsid').prop('disabled', false);

        }

    });

    //$('#ds-site-id').change(function() {

        //var siteId = $(this).val();

        //if(siteId != 0) {

            //var siteVal = siteId.split('/');

            //$('#der').val(siteVal[1]);

        //}

    //});

    /*$('#add_another_company').click(function(e) {

        e.preventDefault();
        
        var ccount = $("#ccount").val();

        $("#ccount").val($ccount + 1);

        $('#addingAnotherCompany').html();

    });*/

    var userTypeId = $('#ohs-utid').val();

    //alert(userTypeId + typeof userTypeId);

        if(userTypeId == '1' || userTypeId == '2') {

            $('#fullCList').css('display', 'none');
            $('#fullSList').css('display', 'none');
            $('#fullScList').css('display', 'none');
            $('#selectedCList').css('display', 'none');
            $('#selectedSList').css('display', 'none');
            $('#selectedScList').css('display', 'none');
            $('#foreperson-user-role').css('display', 'none');
            $('#drug-test-collector').css('display', 'none');

            if(userTypeId == '2') {

               $('#foreperson-user-role').css('display', 'block');
               $('#drug-test-collector').css('display', 'block');

            }


        } else if(userTypeId == '3') {

            $('#fullCList').css('display', 'block');
            $('#fullSList').css('display', 'none');
            $('#fullScList').css('display', 'none');
            $('#selectedCList').css('display', 'block');
            $('#selectedSList').css('display', 'none');
            $('#selectedScList').css('display', 'none');
            $('#foreperson-user-role').css('display', 'block');
            $('#drug-test-collector').css('display', 'none');

        } else if(userTypeId == '4') {

            $('#fullCList').css('display', 'none');
            $('#fullSList').css('display', 'block');
            $('#fullScList').css('display', 'none');
            $('#selectedCList').css('display', 'none');
            $('#selectedSList').css('display', 'block');
            $('#selectedScList').css('display', 'none');
            $('#foreperson-user-role').css('display', 'block');
            $('#drug-test-collector').css('display', 'none');

        } else if(userTypeId == '6') {

            $('#fullCList').css('display', 'block');
            $('#fullSList').css('display', 'none');
            $('#fullScList').css('display', 'block');
            $('#selectedCList').css('display', 'block');
            $('#selectedSList').css('display', 'none');
            $('#selectedScList').css('display', 'block');
            $('#drug-test-collector').css('display', 'none');
            $('#foreperson-user-role').css('display', 'block');

        } else {

            $('#fullCList').css('display', 'block');
            $('#fullSList').css('display', 'block');
            $('#fullScList').css('display', 'block');
            $('#selectedCList').css('display', 'block');
            $('#selectedSList').css('display', 'block');
            $('#selectedScList').css('display', 'block');
            $('#foreperson-user-role').css('display', 'block');
            $('#drug-test-collector').css('display', 'none');

        }

    $('#ohs-utid').change(function() {

        var userTypeId = $(this).val();

        if(userTypeId === '1' || userTypeId === '2') {

            $('#fullCList').css('display', 'none');
            $('#fullSList').css('display', 'none');
            $('#fullScList').css('display', 'none');
            $('#selectedCList').css('display', 'none');
            $('#selectedSList').css('display', 'none');
            $('#selectedScList').css('display', 'none');
            $('#foreperson-user-role').css('display', 'none');
            $('#drug-test-collector').css('display', 'none');

            if(userTypeId === '2') {

               $('#foreperson-user-role').css('display', 'block');
               $('#drug-test-collector').css('display', 'block');

            }


        } else if(userTypeId === '3') {

            $('#fullCList').css('display', 'block');
            $('#fullSList').css('display', 'none');
            $('#fullScList').css('display', 'none');
            $('#selectedCList').css('display', 'block');
            $('#selectedSList').css('display', 'none');
            $('#selectedScList').css('display', 'none');
            $('#foreperson-user-role').css('display', 'block');
            $('#drug-test-collector').css('display', 'none');

        } else if(userTypeId === '4') {

            $('#fullCList').css('display', 'none');
            $('#fullSList').css('display', 'block');
            $('#fullScList').css('display', 'none');
            $('#selectedCList').css('display', 'none');
            $('#selectedSList').css('display', 'block');
            $('#selectedScList').css('display', 'none');
            $('#foreperson-user-role').css('display', 'block');
            $('#drug-test-collector').css('display', 'none');

        } else if(userTypeId === '6') {

            $('#fullCList').css('display', 'block');
            $('#fullSList').css('display', 'none');
            $('#fullScList').css('display', 'block');
            $('#selectedCList').css('display', 'block');
            $('#selectedSList').css('display', 'none');
            $('#selectedScList').css('display', 'block');
            $('#foreperson-user-role').css('display', 'block');
            $('#drug-test-collector').css('display', 'none');

        } else {

            $('#fullCList').css('display', 'block');
            $('#fullSList').css('display', 'block');
            $('#fullScList').css('display', 'block');
            $('#selectedCList').css('display', 'block');
            $('#selectedSList').css('display', 'block');
            $('#selectedScList').css('display', 'block');
            $('#foreperson-user-role').css('display', 'block');
            $('#drug-test-collector').css('display', 'none');

        }

    });

    $('.input-group.date').datepicker({

        format: "mm-dd-yyyy",
        orientation: "auto left",
        autoclose: true,
        todayHighlight: true,
        toggleActive: true

    });

    $('.input-daterange').each(function() {

        $(this).datepicker({

            format: "mm-dd-yyyy",
            orientation: "auto left",
            autoclose: true,
            toggleActive: true

        });

    });

    $('#file').css('display', 'block');

    $('#take_scanner_snapshot').css('display', 'none');

    $('#scan_snapshot').css('display', 'none');

    $('#capture_scanner_picture').click(function(e) {


        e.preventDefault();


        $(this).css('display', 'none');

        $('#take_scanner_snapshot').css('display', 'block');

        Webcam.set({

            width: 400,
            height: 200,
            dest_width: 400,
            dest_height: 200,
            crop_width: 400,
            crop_height: 200,
            image_format: 'jpeg',
            jpeg_quality: 90

        });

        Webcam.attach( '#ohs_scanner_webcam' );

        $('#take_scanner_snapshot').click(function() {

            Webcam.snap( function(data_uri) {

                $('#scannerPictureDataURI').val(data_uri);

                $('#scanner_results').html('<img src="' + data_uri + '" style="height: 100px; width: 200px;"/>');

                $('#scan_snapshot').css('display', 'block');

            });

            $('#scan_snapshot').click(function() {

                e.preventDefault();

                var imgDataURI = $("#scannerPictureDataURI").val();

                console.log(imgDataURI);

                alert(imgDataURI);

                $('#file').val(imgDataURI);

            
            });

        });

    });


    $('#take_snapshot').css('display', 'none');

    $('#save_snapshot').css('display', 'none');

    $('#save_user_snapshot').css('display', 'none');

    /*var location = window.location.href;

    if(location.search('worker/add') > 0) {*/

    $('#capture_picture').click(function(e) {


        e.preventDefault();


        $(this).css('display', 'none');

        $('#take_snapshot').css('display', 'block');

        Webcam.set({

            width: 320,
            height: 240,
            dest_width: 320,
            dest_height: 240,
            crop_width: 200,
            crop_height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90

        });

        Webcam.attach( '#ohs_webcam' );

        $('#take_snapshot').click(function() {

            Webcam.snap( function(data_uri) {

                $('#pictureDataURI').val(data_uri);

                $('#results').html('<img src="' + data_uri + '" style="height: 120px; width: 100px;"/>');

                $('#save_snapshot').css('display', 'block');

                $('#save_user_snapshot').css('display', 'block');

            });

            $('#save_snapshot').click(function() {

                e.preventDefault();
        
                //var id = $("#dp_user_id").val();

                var apiUrl = $("#wsp_api_url").val();
                //alert(apiUrl);

                var imgDataURI = $("#pictureDataURI").val();

                var requestJson = {imgData: imgDataURI};

                $.post(apiUrl, requestJson, function(data, status){

                    var response = JSON.parse(data);

                    if(response.result > 0) {

                        $('#profile_picture').html('<img src="' + imgDataURI + '" style="height: 120px; width: 100px;"/>');

                        $('#results').html('');

                        $('#save_snapshot').css('display', 'none');

                    } else {

                        

                    }

                });

            
            });

            $('#save_user_snapshot').click(function() {

                e.preventDefault();
        
                //var id = $("#dp_user_id").val();

                var apiUrl = $("#usp_api_url").val();
                //alert(apiUrl);

                var imgDataURI = $("#pictureDataURI").val();

                var requestJson = {imgData: imgDataURI};

                $.post(apiUrl, requestJson, function(data, status){

                    var response = JSON.parse(data);

                    if(response.result > 0) {

                        $('#profile_picture').html('<img src="' + imgDataURI + '" style="height: 120px; width: 100px;"/>');

                        $('#results').html('');

                        $('#save_user_snapshot').css('display', 'none');

                    } else {

                        

                    }

                });

            
            });

        });

    });

    $("#w_delete_picture").click(function(e) {

        e.preventDefault();
        
        //var id = $("#dp_user_id").val();

        var apiUrl = $("#wdp_api_url").val();
        //alert(apiUrl);

        $.get(apiUrl, function(data, status){

            var response = JSON.parse(data);
            console.log(data);
            console.log(response.result);

            if(response.result > 0) {

                var defaultPicture = $('#default_picture').val();

                $('#profile_picture').html('<img src="' + defaultPicture + '" style="height: 120px; width: 100px;"/>');

            } else {

                

            }

        });


    });

    $("#u_delete_picture").click(function(e) {

        e.preventDefault();
        

        var apiUrl = $("#udp_api_url").val();
        console.log(apiUrl);

        $.get(apiUrl, function(data, status){

            var response = JSON.parse(data);

            if(response.result > 0) {

                var defaultPicture = $('#default_picture').val();

                $('#profile_picture').html('<img src="' + defaultPicture + '" style="height: 120px; width: 100px;"/>');

            } else {

                

            }

        });


    });

    $('#fileToUpload_emplr').change(function() {

        $('#upload_emplr_report').prop('disabled', false);

    });

    $('#fileToUpload_emple').change(function() {

        $('#upload_emple_report').prop('disabled', false);

    });

    $('#reset_password').click(function(e) {

        e.preventDefault();

        if($('#password1').val() == $('#password2').val()) {

            $('#rpForm').submit();

        } else {

            $('#rpError').html('Password didn\'t match...!');

        }

    });

    $('.btn-danger').click(function(e) {
        
        if(confirm('Are you sure that you want to DELETE this?')) {

        } else {

            e.preventDefault();

        }

    });

    $('#site-key').keyup(function() {

        var key = $(this).val();

        var apiUrl = $("#search_api_url").val() + key;
        //alert(apiUrl);

        $.get(apiUrl, function(data, status){

            var response = JSON.parse(data);
            //console.log(response.result);

            if(response.status = 200) {

                var content = '';


                var sites = response.sites;
                var sCount = response.count;


                var i;
                var j;

                var selectedCount = $('#selected-count').val();
                var sidStr = $('#sid_str').val();
                var sids = sidStr.split('/');

                for(i = 0; i < sCount; i++) {

                    var found = false;

                    for(j = 0; j < selectedCount; j++) {

                        if(sites[i].id == sids[j]) {

                            found = true;
                            break;

                        }

                    }

                    if(found) {

                        var partialContent = '<div class="col-sm-8" style="padding: 3px;" class="form-group">' + sites[i].siteName + '</div><div class="col-sm-4"></div>';

                    } else {

                        var partialContent = '<div class="col-sm-8" style="padding: 3px;" class="form-group">' + sites[i].siteName + '</div><div class="col-sm-4"><a class="select-site" value="' + sites[i].id + '|' + sites[i].siteName + '" href="" class="btn btn-xs btn-info">ADD</a></div>';

                    }
                    

                    content = content + partialContent;

                }

                $('#fullSList').html(content);

                $('.select-site').click(function(e) {
                    e.preventDefault();

                    var siteValue = $(this).attr('value');
                    console.log(siteValue);
                    var selectedCount = $('#selected-count').val();
                    var site = siteValue.split('|');

                    var partialContent = '<div class="col-sm-12" style="padding: 3px;" class="form-group"><input type="checkbox" name="siteOpts[' + parseInt(selectedCount) + ']" value="' + site[0] + '" checked="checked" />' + site[1] + '</div>';

                    var content = $('#selectedSList').html();

                    $('#selectedSList').html(content + partialContent);

                    $(this).css('display', 'none');

                    $('#selected-count').val(parseInt(selectedCount) + 1);

                    var sidStr = $('#sid_str').val();
                    
                    $('#sid_str').val(sidStr + site[0] + '/');

                });

            } else {

                

            }

        });

    });

    var key = '';

    var apiUrl = $("#search_api_url").val() + key;

    $.get(apiUrl, function(data, status){

        var response = JSON.parse(data);
        //console.log(response.result);

        if(response.status = 200) {

            var content = '';


            var sites = response.sites;
            var sCount = response.count;


            var i;
            var j;

            var selectedCount = $('#selected-count').val();
            var sidStr = $('#sid_str').val();
            var sids = sidStr.split('/');

            for(i = 0; i < sCount; i++) {

                var found = false;

                for(j = 0; j < selectedCount; j++) {

                    if(sites[i].id == sids[j]) {

                        found = true;
                        break;

                    }

                }

                if(found) {

                    var partialContent = '<div class="col-sm-8" style="padding: 3px;" class="form-group">' + sites[i].siteName + '</div><div class="col-sm-4"></div>';

                } else {

                    var partialContent = '<div class="col-sm-8" style="padding: 3px;" class="form-group">' + sites[i].siteName + '</div><div class="col-sm-4"><a class="select-site" value="' + sites[i].id + '|' + sites[i].siteName + '" href="" class="btn btn-xs btn-info">ADD</a></div>';

                }
                

                content = content + partialContent;

            }

            $('#fullSList').html(content);

            $('.select-site').click(function(e) {
                e.preventDefault();

                var siteValue = $(this).attr('value');
                console.log(siteValue);
                var selectedCount = $('#selected-count').val();
                var site = siteValue.split('|');

                var partialContent = '<div class="col-sm-12" style="padding: 3px;" class="form-group"><input type="checkbox" name="siteOpts[' + parseInt(selectedCount) + ']" value="' + site[0] + '" checked="checked" />' + site[1] + '</div>';

                var content = $('#selectedSList').html();

                $('#selectedSList').html(content + partialContent);

                $(this).css('display', 'none');

                $('#selected-count').val(parseInt(selectedCount) + 1);

                var sidStr = $('#sid_str').val();
                    
                $('#sid_str').val(sidStr + site[0] + '/');

            });

        } else {

            

        }

    });

    $('#subcontractor-key').keyup(function() {

        var key = $(this).val();

        var apiUrl = $("#sc_search_api_url").val() + key;
        //alert(apiUrl);

        $.get(apiUrl, function(data, status){

            var response = JSON.parse(data);
            //console.log(response.result);

            if(response.status = 200) {

                var content = '';


                var subcontractors = response.subcontractors;
                var scCount = response.count;


                var i;
                var j;

                var selectedCount = $('#sc-selected-count').val();
                var scidStr = $('#scid_str').val();
                var scids = scidStr.split('/');

                for(i = 0; i < scCount; i++) {

                    var found = false;

                    for(j = 0; j < selectedCount; j++) {

                        if(subcontractors[i].id == scids[j]) {

                            found = true;
                            break;

                        }

                    }

                    if(found) {

                        var partialContent = '<div class="col-sm-8" style="padding: 3px;" class="form-group">' + subcontractors[i].companyName + '</div><div class="col-sm-4"></div>';

                    } else {

                        var partialContent = '<div class="col-sm-8" style="padding: 3px;" class="form-group">' + subcontractors[i].companyName + '</div><div class="col-sm-4"><a class="select-subcontractor" value="' + subcontractors[i].id + '|' + subcontractors[i].companyName + '" href="" class="btn btn-xs btn-info">ADD</a></div>';

                    }
                    

                    content = content + partialContent;

                }

                $('#fullScList').html(content);

                $('.select-subcontractor').click(function(e) {
                    e.preventDefault();

                    var scValue = $(this).attr('value');
                    var selectedCount = $('#sc-selected-count').val();
                    var sc = scValue.split('|');

                    var partialContent = '<div class="col-sm-12" style="padding: 3px;" class="form-group"><input type="checkbox" name="scOpts[' + parseInt(selectedCount) + ']" value="' + sc[0] + '" checked="checked" />' + sc[1] + '</div>';

                    var content = $('#selectedScList').html();

                    $('#selectedScList').html(content + partialContent);

                    $(this).css('display', 'none');

                    $('#sc-selected-count').val(parseInt(selectedCount) + 1);

                    var scidStr = $('#scid_str').val();

                    $('#scid_str').val(scidStr + sc[0] + '/');

                });

            } else {

                

            }

        });

    });

    var scKey = '';

    var scApiUrl = $("#sc_search_api_url").val() + scKey;

    $.get(scApiUrl, function(data, status){

        var response = JSON.parse(data);
        //console.log(response.result);

        if(response.status = 200) {

            var content = '';


            var subcontractors = response.subcontractors;
            var scCount = response.count;


            var i;
            var j;

            var selectedCount = $('#sc-selected-count').val();
            var scidStr = $('#scid_str').val();
            var scids = scidStr.split('/');

            for(i = 0; i < scCount; i++) {

                var found = false;

                for(j = 0; j < selectedCount; j++) {

                    if(subcontractors[i].id == scids[j]) {

                        found = true;
                        break;

                    }

                }

                if(found) {

                    var partialContent = '<div class="col-sm-8" style="padding: 3px;" class="form-group">' + subcontractors[i].companyName + '</div><div class="col-sm-4"></div>';

                } else {

                    var partialContent = '<div class="col-sm-8" style="padding: 3px;" class="form-group">' + subcontractors[i].companyName + '</div><div class="col-sm-4"><a class="select-subcontractor" value="' + subcontractors[i].id + '|' + subcontractors[i].companyName + '" href="" class="btn btn-xs btn-info">ADD</a></div>';

                }
                

                content = content + partialContent;

            }

            $('#fullScList').html(content);

            $('.select-subcontractor').click(function(e) {
                e.preventDefault();

                var scValue = $(this).attr('value');
                var selectedCount = $('#sc-selected-count').val();
                var sc = scValue.split('|');

                var partialContent = '<div class="col-sm-12" style="padding: 3px;" class="form-group"><input type="checkbox" name="scOpts[' + parseInt(selectedCount) + ']" value="' + sc[0] + '" checked="checked" />' + sc[1] + '</div>';

                var content = $('#selectedScList').html();

                $('#selectedScList').html(content + partialContent);

                $(this).css('display', 'none');

                $('#sc-selected-count').val(parseInt(selectedCount) + 1);

                var scidStr = $('#scid_str').val();
                    
                $('#scid_str').val(scidStr + sc[0] + '/');

            });

        } else {

            

        }

    });

    $('#company-key').keyup(function() {

        var key = $(this).val();

        var apiUrl = $("#c_search_api_url").val() + key;
        //alert(apiUrl);

        $.get(apiUrl, function(data, status){

            var response = JSON.parse(data);
            //console.log(response.result);

            if(response.status = 200) {

                var content = '';


                var companies = response.companies;
                var cCount = response.count;


                var i;
                var j;

                var selectedCount = $('#c-selected-count').val();
                var cidStr = $('#cid_str').val();
                var cids = cidStr.split('/');

                for(i = 0; i < cCount; i++) {

                    var found = false;

                    for(j = 0; j < selectedCount; j++) {

                        if(companies[i].id == cids[j]) {

                            found = true;
                            break;

                        }

                    }

                    if(found) {

                        var partialContent = '<div class="col-sm-8" style="padding: 3px;" class="form-group">' + companies[i].companyName + '</div><div class="col-sm-4"></div>';

                    } else {

                        var partialContent = '<div class="col-sm-8" style="padding: 3px;" class="form-group">' + companies[i].companyName + '</div><div class="col-sm-4"><a class="select-company" value="' + companies[i].id + '|' + companies[i].companyName + '" href="" class="btn btn-xs btn-info">ADD</a></div>';

                    }
                    

                    content = content + partialContent;

                }

                $('#fullCList').html(content);

                $('.select-company').click(function(e) {
                    e.preventDefault();

                    var cValue = $(this).attr('value');
                    var selectedCount = $('#c-selected-count').val();
                    var c = cValue.split('|');

                    var partialContent = '<div class="col-sm-12" style="padding: 3px;" class="form-group"><input type="checkbox" name="companyOpts[' + parseInt(selectedCount) + ']" value="' + c[0] + '" checked="checked" />' + c[1] + '</div>';

                    var content = $('#selectedCList').html();

                    $('#selectedCList').html(content + partialContent);

                    $(this).css('display', 'none');

                    $('#c-selected-count').val(parseInt(selectedCount) + 1);

                    var cidStr = $('#cid_str').val();

                    $('#cid_str').val(cidStr + c[0] + '/');

                });

            } else {

                

            }

        });

    });

    var cKey = '';

    var cApiUrl = $("#c_search_api_url").val() + cKey;

    $.get(cApiUrl, function(data, status){

        var response = JSON.parse(data);
        //console.log(response.result);

        if(response.status = 200) {

            var content = '';


            var companies = response.companies;
            var cCount = response.count;


            var i;
            var j;

            var selectedCount = $('#c-selected-count').val();
            var cidStr = $('#cid_str').val();
            var cids = cidStr.split('/');

            for(i = 0; i < cCount; i++) {

                var found = false;

                for(j = 0; j < selectedCount; j++) {

                    if(companies[i].id == cids[j]) {

                        found = true;
                        break;

                    }

                }

                if(found) {

                    var partialContent = '<div class="col-sm-8" style="padding: 3px;" class="form-group">' + companies[i].companyName + '</div><div class="col-sm-4"></div>';

                } else {

                    var partialContent = '<div class="col-sm-8" style="padding: 3px;" class="form-group">' + companies[i].companyName + '</div><div class="col-sm-4"><a class="select-company" value="' + companies[i].id + '|' + companies[i].companyName + '" href="" class="btn btn-xs btn-info">ADD</a></div>';

                }
                

                content = content + partialContent;

            }

            $('#fullCList').html(content);

            $('.select-company').click(function(e) {
                e.preventDefault();

                var cValue = $(this).attr('value');
                var selectedCount = $('#c-selected-count').val();
                var c = cValue.split('|');

                var partialContent = '<div class="col-sm-12" style="padding: 3px;" class="form-group"><input type="checkbox" name="companyOpts[' + parseInt(selectedCount) + ']" value="' + c[0] + '" checked="checked" />' + c[1] + '</div>';

                var content = $('#selectedCList').html();

                $('#selectedCList').html(content + partialContent);

                $(this).css('display', 'none');

                $('#c-selected-count').val(parseInt(selectedCount) + 1);

                var cidStr = $('#cid_str').val();

                $('#cid_str').val(cidStr + c[0] + '/');

            });

        } else {

            

        }

    });

    $('#take_cert_front').css('display', 'none');

    $('#capture_cert_front').click(function(e) {


        e.preventDefault();

        $(this).css('display', 'none');

        $('#take_cert_front').css('display', 'block');

        Webcam.set({

            width: 320,
            height: 240,
            dest_width: 320,
            dest_height: 240,
            crop_width: 200,
            crop_height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90

        });

        Webcam.attach( '#ohs_webcam_cert_front' );

        $('#take_cert_front').click(function() {

            Webcam.snap( function(data_uri) {

                $('#certFrontDataURI').val(data_uri);

                $('#cert-front-results').html('<img src="' + data_uri + '" style="height: 120px; width: 100px;"/>');

            });
        });
    });

    $('#take_cert_back').css('display', 'none');

    $('#capture_cert_back').click(function(e) {


        e.preventDefault();

        $(this).css('display', 'none');

        $('#take_cert_back').css('display', 'block');

        Webcam.set({

            width: 320,
            height: 240,
            dest_width: 320,
            dest_height: 240,
            crop_width: 200,
            crop_height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90

        });

        Webcam.attach( '#ohs_webcam_cert_back' );

        $('#take_cert_back').click(function() {

            Webcam.snap( function(data_uri) {

                $('#certBackDataURI').val(data_uri);

                $('#cert-back-results').html('<img src="' + data_uri + '" style="height: 120px; width: 100px;"/>');

            });
        });
    });

    window.onbeforeunload = confirmLeave();
    //document.ready = setForm();

});

