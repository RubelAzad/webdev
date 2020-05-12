
<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="{{url('magic/js/plugin/pace/pace.min.js')}}"></script>

<script src="{{url('js/app.js')}}"></script> <!-- Jquery and bootstrap -->

{{--<script src="{{url('magic/js/libs/jquery-ui.min.js')}}"></script>--}}

<!-- IMPORTANT: APP CONFIG -->
<script src="{{url('magic/js/app.config.js')}}"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
{{--<script src="{{url('magic/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js')}}"></script>--}}


<!-- CUSTOM NOTIFICATION -->
<script src="{{url('magic/js/notification/SmartNotification.min.js')}}"></script>

<script src="{{url('https://code.jquery.com/ui/1.12.1/jquery-ui.min.js')}}"></script>

<!-- JARVIS WIDGETS -->
<script src="{{url('magic/js/smartwidgets/jarvis.widget.min.js')}}"></script>

<!-- EASY PIE CHARTS -->
<script src="{{url('magic/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js')}}"></script>

<!-- SPARKLINES -->
<script src="{{url('magic/js/plugin/sparkline/jquery.sparkline.min.js')}}"></script>


<!-- JQUERY MASKED INPUT -->
<script src="{{url('magic/js/plugin/masked-input/jquery.maskedinput.min.js')}}"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="{{url('magic/js/plugin/select2/select2.min.js')}}"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="{{url('magic/js/plugin/bootstrap-slider/bootstrap-slider.min.js')}}"></script>

<!-- browser msie issue fix -->
<script src="{{url('magic/js/plugin/msie-fix/jquery.mb.browser.min.js')}}"></script>

<!-- FastClick: For mobile devices -->
<script src="{{url('magic/js/plugin/fastclick/fastclick.min.js')}}"></script>
<!-- print copy -->
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.min.js')}}"></script>


<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->



<script src="{{url('magic/plugins/datatables/datatables.min.js')}}"></script>


<script src="{{url('common/js/global.js')}}"></script>

<!-- MAIN APP JS FILE -->
<script src="{{url('magic/js/app.js')}}"></script>

@stack('scripts')