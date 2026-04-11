<div class="container py-4">

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('setting.gateway.process') }}" method="post" id="bktForm">

            <!-- 🔘 Gateway चयन -->
            <div class="mb-4">
                <label class="form-label">Select SMS Gateway</label>
                <select class="form-select" id="gatewaySelect" name="sms_gateway">
                    @foreach($gateways as $key => $gateway)
                        <option value="{{ $key }}" {{ (isset($details->sms_gateway) && $details->sms_gateway == $key) ? 'selected' : '' }}>
                            {{ $gateway }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- 🔵 TWILIO SETTINGS -->
            <div id="twilioFields" @if(isset($details->sms_gateway) && $details->sms_gateway != 2) style="display:none;" @endif>

                <h6 class="fw-semibold mb-3">Twilio Configuration</h6>

                <div class="mb-3">
                    <label class="form-label">Account SID</label>
                    <input type="text" class="form-control" name="twilio_sid" value="{{ old('twilio_sid', $details->twilio_sid ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Auth Token</label>
                    <input type="text" class="form-control" name="twilio_token" value="{{ old('twilio_token', $details->twilio_token ?? '') }}">
                </div>


            </div>

            <!-- 🟢 SEMAPHORE SETTINGS -->
            <div id="semaphoreFields" @if(isset($details->sms_gateway) && $details->sms_gateway != 1) style="display:none;" @endif>

                <h6 class="fw-semibold mb-3">Semaphore Configuration</h6>

                <div class="mb-3">
                    <label class="form-label">API Key</label>
                    <input type="text" class="form-control" name="semaphore_api_key" value="{{ old('semaphore_api_key', $details->semaphore_api_key ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Sender Name</label>
                    <input type="text" class="form-control" name="semaphore_sender" value="{{ old('semaphore_sender', $details->semaphore_sender ?? '') }}">
                </div>

            </div>

            </form>
            <!-- 💾 SAVE BUTTON -->
            <div class="text-end mt-4">
                <button  data-form="bktForm"  class="btn btn-primary px-4 rounded-3 cuBtn">
                    Save Settings
                </button>
            </div>

        </div>
    </div>

</div>