@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Toastr Notifications
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link href="{{ asset('assets/css/pages/toastr.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/vendors/toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Toastr Notification</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                Home
            </a>
        </li>
        <li>
            <a href="#">UI features</a>
        </li>
        <li class="active">Toastr Notification</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet info box">
                <div class="portlet-title">
                    <div class="caption"> <i class="livicon" data-name="bell" data-c="#fff" data-hc="white" data-size="18" data-loop="true"></i>
                        Toastr Notification
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="title">Title</label>
                                <input id="title" type="text" class="form-control" value="Toastr Notifications" placeholder="Enter a title ..."></div>
                            <div class="form-group">
                                <label class="control-label" for="message">Message</label>
                                <textarea class="form-control" id="message" rows="3" placeholder="Enter a message ...">Gnome &amp; Growl type non-blocking notifications</textarea>
                            </div>
                            <div class="form-group">
                                <div class="checkbox-list">
                                    <label for="closeButton">
                                        <div class="checker" id="uniform-closeButton">
                                            <span class="checked">
                                                <input id="closeButton" type="checkbox" value="checked" checked="" class="input-small"></span>
                                        </div>
                                        Close Button
                                    </label>
                                    <label for="addBehaviorOnToastClick">
                                        <div class="checker" id="uniform-addBehaviorOnToastClick">
                                            <span>
                                                <input id="addBehaviorOnToastClick" type="checkbox" value="checked" class="input-small"></span>
                                        </div>
                                        Add behavior on toast click
                                    </label>
                                    <label for="debugInfo">
                                        <div class="checker" id="uniform-debugInfo">
                                            <span>
                                                <input id="debugInfo" type="checkbox" value="checked" class="input-small"></span>
                                        </div>
                                        Debug
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div class="form-group" id="toastTypeGroup">
                                <label>Toast Type</label>
                                <div class="radio-list padding-right10">
                                    <label>
                                        <div class="radio">
                                            <span class="checked">
                                                <input type="radio" name="toasts" value="success" checked=""></span>
                                        </div>
                                        Success
                                    </label>
                                    <label>
                                        <div class="radio">
                                            <span>
                                                <input type="radio" name="toasts" value="info"></span>
                                        </div>
                                        Info
                                    </label>
                                    <label>
                                        <div class="radio">
                                            <span>
                                                <input type="radio" name="toasts" value="warning"></span>
                                        </div>
                                        Warning
                                    </label>
                                    <label>
                                        <div class="radio">
                                            <span>
                                                <input type="radio" name="toasts" value="error"></span>
                                        </div>
                                        Error
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" id="positionGroup">
                                <label>Position</label>
                                <div class="radio-list">
                                    <label>
                                        <div class="radio">
                                            <span class="checked">
                                                <input type="radio" name="positions" value="toast-top-right" checked=""></span>
                                        </div>
                                        Top Right
                                    </label>
                                    <label>
                                        <div class="radio">
                                            <span>
                                                <input type="radio" name="positions" value="toast-bottom-right"></span>
                                        </div>
                                        Bottom Right
                                    </label>
                                    <label>
                                        <div class="radio">
                                            <span>
                                                <input type="radio" name="positions" value="toast-bottom-left"></span>
                                        </div>
                                        Bottom Left
                                    </label>
                                    <label>
                                        <div class="radio">
                                            <span>
                                                <input type="radio" name="positions" value="toast-top-left"></span>
                                        </div>
                                        Top Left
                                    </label>
                                    <label>
                                        <div class="radio">
                                            <span>
                                                <input type="radio" name="positions" value="toast-top-full-width"></span>
                                        </div>
                                        Top Full Width
                                    </label>
                                    <label>
                                        <div class="radio">
                                            <span>
                                                <input type="radio" name="positions" value="toast-bottom-full-width"></span>
                                        </div>
                                        Bottom Full Width
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="controls">
                                    <label class="control-label" for="showEasing">Show Easing</label>
                                    <input id="showEasing" type="text" placeholder="swing, linear" class="form-control input-small" value="swing">
                                    <label class="control-label" for="hideEasing">Hide Easing</label>
                                    <input id="hideEasing" type="text" placeholder="swing, linear" class="form-control input-small" value="linear">
                                    <label class="control-label" for="showMethod">Show Method</label>
                                    <input id="showMethod" type="text" placeholder="show, fadeIn, slideDown" class="form-control input-small" value="fadeIn">
                                    <label class="control-label" for="hideMethod">Hide Method</label>
                                    <input id="hideMethod" type="text" placeholder="hide, fadeOut, slideUp" class="form-control input-small" value="fadeOut"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="controls">
                                    <label class="control-label" for="showDuration">Show Duration</label>
                                    <input id="showDuration" type="text" placeholder="ms" class="form-control input-small" value="1000">
                                    <label class="control-label" for="hideDuration">Hide Duration</label>
                                    <input id="hideDuration" type="text" placeholder="ms" class="form-control input-small" value="1000">
                                    <label class="control-label" for="timeOut">Time out</label>
                                    <input id="timeOut" type="text" placeholder="ms" class="form-control input-small" value="5000">
                                    <label class="control-label" for="timeOut">Extended time out</label>
                                    <input id="extendedTimeOut" type="text" placeholder="ms" class="form-control input-small" value="1000"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-green toastrshow" id="showtoast">Show Toast</button>
                            <button type="button" class="btn btn-red toastrshow" id="cleartoasts">Clear Toasts</button>
                            <button type="button" class="btn btn-red toastrshow" id="clearlasttoast">Clear Last Toast</button>
                        </div>
                    </div>
                    <br/>
                    <div class="row margin-top-10">
                        <div class="col-md-12">
                            <pre id="toastrOptions">Settings... </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript">
    $(document).on('click', '.panel-heading span.clickable', function(e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }
    })
    </script>
<script src="{{ asset('assets/vendors/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/vendors/toastr/ui-toastr.js') }}"></script>
<script type="text/javascript">
    $(function() {
        var i = -1;
        var toastCount = 0;
        var $toastlast;

        var getMessage = function() {
            var msgs = ['My name is Inigo Montoya. You killed my father. Prepare to die!',
                '<div><input class="input-small" value="textbox"/>&nbsp;<a href="http://johnpapa.net" target="_blank">This is a hyperlink</a></div><div><button type="button" id="okBtn" class="btn btn-primary">Close me</button><button type="button" id="surpriseBtn" class="btn" style="margin: 0 8px 0 8px">Surprise me</button></div>',
                'Are you the six fingered man?',
                'Inconceivable!',
                'I do not think that means what you think it means.',
                'Have fun storming the castle!'
            ];
            i++;
            if (i === msgs.length) {
                i = 0;
            }

            return msgs[i];
        };
        $('#showtoast').click(function() {
            var shortCutFunction = $("#toastTypeGroup input:radio:checked").val();
            var msg = $('#message').val();
            var title = $('#title').val() || '';
            var $showDuration = $('#showDuration');
            var $hideDuration = $('#hideDuration');
            var $timeOut = $('#timeOut');
            var $extendedTimeOut = $('#extendedTimeOut');
            var $showEasing = $('#showEasing');
            var $hideEasing = $('#hideEasing');
            var $showMethod = $('#showMethod');
            var $hideMethod = $('#hideMethod');
            var toastIndex = toastCount++;

            toastr.options = {
                closeButton: $('#closeButton').prop('checked'),
                debug: $('#debugInfo').prop('checked'),
                positionClass: $('#positionGroup input:radio:checked').val() || 'toast-top-right',
                onclick: null
            };

            if ($('#addBehaviorOnToastClick').prop('checked')) {
                toastr.options.onclick = function() {
                    alert('You can perform some custom action after a toast goes away');
                };
            }

            if ($showDuration.val().length) {
                toastr.options.showDuration = $showDuration.val();
            }

            if ($hideDuration.val().length) {
                toastr.options.hideDuration = $hideDuration.val();
            }

            if ($timeOut.val().length) {
                toastr.options.timeOut = $timeOut.val();
            }

            if ($extendedTimeOut.val().length) {
                toastr.options.extendedTimeOut = $extendedTimeOut.val();
            }

            if ($showEasing.val().length) {
                toastr.options.showEasing = $showEasing.val();
            }

            if ($hideEasing.val().length) {
                toastr.options.hideEasing = $hideEasing.val();
            }

            if ($showMethod.val().length) {
                toastr.options.showMethod = $showMethod.val();
            }

            if ($hideMethod.val().length) {
                toastr.options.hideMethod = $hideMethod.val();
            }

            if (!msg) {
                msg = getMessage();
            }

            $("#toastrOptions").text("Command: toastr[" + shortCutFunction + "](\"" + msg + (title ? "\", \"" + title : '') + "\")\n\ntoastr.options = " + JSON.stringify(toastr.options, null, 2));

            var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
            $toastlast = $toast;
            if ($toast.find('#okBtn').length) {
                $toast.delegate('#okBtn', 'click', function() {
                    alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
                    $toast.remove();
                });
            }
            if ($toast.find('#surpriseBtn').length) {
                $toast.delegate('#surpriseBtn', 'click', function() {
                    alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
                });
            }
        });

        function getLastToast() {
            return $toastlast;
        }
        $('#clearlasttoast').click(function() {
            toastr.clear(getLastToast());
        });
        $('#cleartoasts').click(function() {
            toastr.clear();
        });
    })
    </script>
@stop