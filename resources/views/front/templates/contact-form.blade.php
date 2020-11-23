<div class="formInfo">
    {{ ShowLabelById(11,$lang_id) }}
</div>
<form method="POST" action="{{ url($lang, ['simpleFeedback', 'feedback']) }}" id="contact-form" enctype="multipart/form-data" class="contact">
    <div class="input"><input type="text" name="name" placeholder="{{ __('Name') }}*" required></div>
    <div class="input"><input type="text" name="phone" placeholder="{{ __('Phone') }}*" required></div>
    <div class="input"><input type="email" name="email" placeholder="Email*" required></div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" onclick="saveForm(this)" data-form-id="contact-form">{{__('Send')}}</button>
    <div class="feedback_response " style="z-index:1;"></div>
</form>
