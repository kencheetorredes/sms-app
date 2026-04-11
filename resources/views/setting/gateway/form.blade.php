<div class="container py-4">

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">


            <!-- 🔘 Gateway चयन -->
            <div class="mb-4">
                <label class="form-label">Select SMS Gateway</label>
                <select class="form-select" id="gatewaySelect">
                    <option value="twilio">Twilio</option>
                    <option value="semaphore">Semaphore (PH)</option>
                </select>
            </div>

            <!-- 🔵 TWILIO SETTINGS -->
            <div id="twilioFields">

                <h6 class="fw-semibold mb-3">Twilio Configuration</h6>

                <div class="mb-3">
                    <label class="form-label">Account SID</label>
                    <input type="text" class="form-control" name="twilio_sid">
                </div>

                <div class="mb-3">
                    <label class="form-label">Auth Token</label>
                    <input type="text" class="form-control" name="twilio_token">
                </div>

                <div class="mb-3">
                    <label class="form-label">From Number</label>
                    <input type="text" class="form-control" name="twilio_from">
                </div>

            </div>

            <!-- 🟢 SEMAPHORE SETTINGS -->
            <div id="semaphoreFields" style="display:none;">

                <h6 class="fw-semibold mb-3">Semaphore Configuration</h6>

                <div class="mb-3">
                    <label class="form-label">API Key</label>
                    <input type="text" class="form-control" name="semaphore_api_key">
                </div>

                <div class="mb-3">
                    <label class="form-label">Sender Name</label>
                    <input type="text" class="form-control" name="semaphore_sender">
                </div>

            </div>

            <!-- 💾 SAVE BUTTON -->
            <div class="text-end mt-4">
                <button class="btn btn-primary px-4 rounded-3">
                    Save Settings
                </button>
            </div>

        </div>
    </div>

</div>