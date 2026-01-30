{include file='globalheader.tpl'}

<div id="page-manage-zalo" class="admin-page">
    <h1 class="border-bottom mb-3">{translate key=ZaloConfiguration}</h1>

    {if isset($ErrorMessage) && $ErrorMessage ne ''}
        <div class="alert alert-danger">
            {$ErrorMessage|escape}
        </div>
    {/if}

    {if isset($SuccessMessage) && $SuccessMessage ne ''}
        <div class="alert alert-success">
            {$SuccessMessage|escape}
        </div>
    {/if}

    <div class="card shadow">
        <div class="card-body">
            <form id="frmZaloConfig" method="post" action="{$SCRIPT_NAME}?action=save" role="form">
                <div class="mb-3">
                    <label for="api_url" class="form-label fw-bold">{translate key=ZaloApiUrl}</label>
                    <input type="text"
                           class="form-control"
                           id="api_url"
                           name="api_url"
                           value="{$ZaloConfig.apiUrl|escape}"
                           placeholder="http://localhost:3000/v1/messages/send" />
                    <div class="form-text">
                        {translate key=ZaloApiUrlHelp}
                    </div>
                </div>

                <div class="mb-3">
                    <label for="api_key" class="form-label fw-bold">API Key</label>
                    <input type="password"
                           class="form-control"
                           id="api_key"
                           name="api_key"
                           value="{$ZaloConfig.apiKey|escape}" />
                    <div class="form-text">
                        {translate key=ZaloApiKeyHelp}
                    </div>
                </div>

                <div class="mb-3">
                    <label for="recipient_uid" class="form-label fw-bold">{translate key=ZaloDefaultUID}</label>
                    <input type="text"
                           class="form-control"
                           id="recipient_uid"
                           name="recipient_uid"
                           value="{$ZaloConfig.recipientUID|escape}"
                           placeholder="uid1,uid2,uid3" />
                    <div class="form-text">
                        {translate key=ZaloDefaultUIDHelp}
                    </div>
                </div>

                <div class="mb-3">
                    <label for="recipient_group_id" class="form-label fw-bold">{translate key=ZaloDefaultGroupID}</label>
                    <input type="text"
                           class="form-control"
                           id="recipient_group_id"
                           name="recipient_group_id"
                           value="{$ZaloConfig.recipientGroupID|escape}"
                           placeholder="gid1,gid2" />
                    <div class="form-text">
                        {translate key=ZaloDefaultGroupIDHelp}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox"
                               class="form-check-input"
                               id="send_image_with_notification"
                               name="send_image_with_notification"
                               value="1"
                               {if $ZaloConfig.sendImageWithNotification}checked="checked"{/if} />
                        <label class="form-check-label fw-bold" for="send_image_with_notification">
                            {translate key=ZaloSendImageWithNotification}
                        </label>
                    </div>
                    <div class="form-text">
                        {translate key=ZaloSendImageWithNotificationHelp}
                    </div>
                </div>

                <hr />

                <div class="mb-3">
                    <label for="per_resource_json" class="form-label fw-bold">{translate key=ZaloPerResourceJson}</label>
                    <textarea class="form-control"
                              id="per_resource_json"
                              name="per_resource_json"
                              rows="12"
                              spellcheck="false">{$ZaloConfig.perResourceJson|escape}</textarea>
                    <div class="form-text">
                        {translate key=ZaloPerResourceJsonFormat}
<pre class="mb-0" style="white-space: pre; font-size: 0.85rem;">
{
  "5": {
    "recipientUID": "uid1,uid2",
    "recipientGroupID": "gid1"
  },
  "10": {
    "recipientUID": "",
    "recipientGroupID": "gid2,gid3"
  }
}
</pre>
                        {translate key=ZaloPerResourceJsonHelp}
                    </div>
                </div>

                {csrf_token}

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        {translate key=SaveConfiguration}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{include file='globalfooter.tpl'}

