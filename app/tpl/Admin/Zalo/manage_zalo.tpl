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
                    <label for="api_url" class="form-label fw-bold">URL API Zalo</label>
                    <input type="text"
                           class="form-control"
                           id="api_url"
                           name="api_url"
                           value="{$ZaloConfig.apiUrl|escape}"
                           placeholder="http://localhost:3000/v1/messages/send" />
                    <div class="form-text">
                        URL endpoint của Zalo API server (Node.js) dùng để gửi tin nhắn.
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
                        API Key dùng để xác thực từ ứng dụng này tới Zalo API server.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="recipient_uid" class="form-label fw-bold">UID mặc định</label>
                    <input type="text"
                           class="form-control"
                           id="recipient_uid"
                           name="recipient_uid"
                           value="{$ZaloConfig.recipientUID|escape}"
                           placeholder="uid1,uid2,uid3" />
                    <div class="form-text">
                        Danh sách UID nhận tin nhắn mặc định (cách nhau bởi dấu phẩy), dùng khi resource không có cấu hình riêng.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="recipient_group_id" class="form-label fw-bold">GROUPID mặc định</label>
                    <input type="text"
                           class="form-control"
                           id="recipient_group_id"
                           name="recipient_group_id"
                           value="{$ZaloConfig.recipientGroupID|escape}"
                           placeholder="gid1,gid2" />
                    <div class="form-text">
                        Danh sách GROUPID nhận tin nhắn mặc định (cách nhau bởi dấu phẩy), dùng khi resource không có cấu hình riêng.
                    </div>
                </div>

                <hr />

                <div class="mb-3">
                    <label for="per_resource_json" class="form-label fw-bold">Cấu hình theo ResourceId (JSON)</label>
                    <textarea class="form-control"
                              id="per_resource_json"
                              name="per_resource_json"
                              rows="12"
                              spellcheck="false">{$ZaloConfig.perResourceJson|escape}</textarea>
                    <div class="form-text">
                        Định dạng:
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
                        Key là <strong>ResourceId</strong> (ví dụ giá trị của input ẩn <code>#primaryResourceId</code> trong form đặt chỗ).
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

