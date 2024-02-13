{extends file='page.tpl'}

{block name="content"}
    <section id="main" style="margin-bottom: 1.563rem;">
        <div class="row product-container js-product-container">
            <div class="col-md-6">
                <img src="{$QR_GENERATE}" style="width: 100%;" />
            </div>
            <div class="col-md-6">
                <h1>{$PRICE}</h1>
                <input type="radio" name="onlinepayment_option" id="qrpayment_option" />
                <label for="qrpayment_option">QR Payment</label>
                <input type="radio" name="onlinepayment_option" id="banktransfer_option" />
                <label for="banktransfer_option">Bank Transfer</label>
                <form method="post" enctype="multipart/form-data">
                    <label for="slip_upload">แนบสลิปการโอน</label>
                    <input type="file" name="slip_upload" id="slip_upload" />
                    <button type="submit" name="placeorder">
                        Upload
                    </button>
                </form>
            </div>
        </div>
    </section>
{/block}