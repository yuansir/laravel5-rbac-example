@if($alert = Session::get('am-alert'))
<div class="am-alert am-alert-{{ $alert['type'] }}" data-am-alert data-am-sticky="{animation: 'slide-top'}">
    <button type="button" class="am-close">&times;</button>
    @if($alert['type'] == 'success')
    <h4>成功</h4>
    @elseif($alert['type'] == 'warning')
    <h4>警告</h4>
    @elseif($alert['type'] == 'danger')
    <h4>错误</h4>
    @else
    <h4>提示</h4>
    @endif
    @foreach($alert['data'] as $item)
    <p>{{ $item }}</p>
    @endforeach
</div>
@endif