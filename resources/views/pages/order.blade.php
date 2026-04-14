@extends('layouts.app', ['pageTitle' => 'order.php'])

@section('content')
query($sql);
?>



<div class="deals-container">
        <div class="deal-info">
            <strong style="font-size:13px;">Carrier Deals at Apple</strong><br>
            <a href="#" class="see-all">See all deals âž•</a>
        </div>
        <div class="deal-item">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-att?wid=24&hei=24&fmt=png-alpha&.v=1658193314821"
                alt="Carrier 1">
            <span>Save up to $1000 after trade-in.</span>
        </div>
        <div class="deal-item">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-lightyear?wid=24&hei=24&fmt=png-alpha&.v=1724793407797"
                alt="Carrier 2">
            <span>Save up to $1000. No trade-in needed.</span>
        </div>
        <div class="deal-item">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-tmobile?wid=24&hei=24&fmt=png-alpha&.v=1658193314615"
                alt="Carrier 3">
            <span>Save up to $1000 after trade-in.</span>
        </div>
        <div class="deal-item">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-verizon?wid=24&hei=24&fmt=png-alpha&.v=1725054383893"
                alt="Carrier 4">
            <span>Save up to $1000 after trade-in.</span>
        </div>
    </div>

    <div class="purchase-container">
        <div>
            <h1 style="font-size: 48px; font-weight: bold;">Buy iPhone 16 Pro</h1>
            <p style="font-size: 17px;">From $999 or $41.62/mo. for 24 mo.*</p>
            <div class="apple-intelligence">
                <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-selector-icon-apple-intelligence-202409?wid=17&hei=21&fmt=p-jpg&qlt=95&.v=1724970464935"
                    alt="Apple Intelligence">
                <span>Apple Intelligence<sup>8</sup></span>
            </div>
        </div>
        <div class="offer-buttons">
            <button class="offer-button" style="width:270px;">Get $40â€“$630 for your trade-in. âž•</button>
            <button class="offer-button">Get 3% Daily Cash back with Apple Card. âž•</button>
        </div>
    </div>


    <div class="rf-bfe-main row">
        <div class="rf-bfe-column-left">
            <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/iphone-16-pro-model-unselect-gallery-1-202409?wid=5120&hei=2880&fmt=webp&qlt=70&.v=aWs5czA5aDFXU0FlMGFGRlpYRXk2UWFRQXQ2R0JQTk5udUZxTkR3ZVlpTEJnOG9obkp6NERCS3lnVm1tcnlVUjBoUVhuTWlrY2hIK090ZGZZbk9HeE1xUVVnSHY5eU9CcGxDMkFhalkvT0NuWUpOMGpEMHVTZEtYYVA3c1B3UzVmbW94YnYxc1YvNXZ4emJGL0IxNFp3&traceId=1"
                alt="Product Image" style="width:930px; height: 570px; padding-bottom: 50px;">

            <h3><strong>Apple Trade In.</strong> Get $40â€“$630 credit toward your new iPhone.</h3>
            <div class="trade-options">
                <div class="trade-card" style="font-size: 19px;">Select a smartphone<br><small
                        style="font-size: 12px; font-weight: lighter;">Answer a few questions to get your
                        estimate.</small></div>
                <div class="trade-card" style="font-size: 19px;">
                    <p style="padding-top: 12px;">No trade-in</p>
                </div>
            </div>

            <h3><strong>Payment options.</strong> Select the one that works for you.</h3>
            <div class="payment-options">
                <div class="payment-card"><strong>Buy</strong>
                    <p>Pay with Apple Pay or other payment methods.</p>
                </div>
                <div class="payment-card"><strong>Finance</strong>
                    <p>Pay over time at 0% APR.</p>
                </div>
                <div class="payment-card"><strong>Apple iPhone Upgrade Program</strong>
                    <p>Pay monthly at 0% APR with the option to upgrade to a new iPhone every year.</p>
                </div>
            </div>
        </div>
        <div class="rf-bfe-column-right">
            <h2><strong>Model.</strong> Which is best for you?</h2>

            <div class="model-card">
                <div>
                    <strong>iPhone 16 Pro</strong>
                    <p>6.3-inch display</p>
                </div>
                <div>
                    <p>From $999 or $41.62/mo. <br> for 24 mo.*</p>
                </div>
            </div>

            <div class="model-card">
                <div>
                    <strong>iPhone 16 Pro Max</strong>
                    <p>6.9-inch display</p>
                </div>
                <div>
                    <p>From $1199 or $49.95/mo.<br> for 24 mo.*</p>
                </div>
            </div>

            <div class="help-box">
                <strong>Need help choosing a model?</strong>
                <p>Explore the differences in screen size and battery life.</p>
            </div>

            <br>
            <h2><strong>Finish.</strong> Pick your favorite.</h2>
            <br>
            <b>Color</b>
            <div class="color-options" style="padding:10px">
                <div class="color-circle" style="background-color: #F3E2D1;"></div>
                <div class="color-circle" style="background-color: #EDEDED;"></div>
                <div class="color-circle" style="background-color: #FFFFFF;"></div>
                <div class="color-circle" style="background-color: #B0B0B0;"></div>
            </div>

            <br>
            <br>
            <h2><strong>Storage.</strong> How much space do you need?</h2>

            <div class="storage-card">
                <div>
                    <strong>128GBÂ²</strong>
                </div>
                <div>
                    <p>From $999 or $41.62/mo. for 24 mo.*</p>
                </div>
            </div>

            <div class="storage-card">
                <div>
                    <strong>256GBÂ²</strong>
                </div>
                <div>
                    <p>From $1099 or $45.79/mo. for 24 mo.*</p>
                </div>
            </div>

            <div class="storage-card">
                <div>
                    <strong>512GBÂ²</strong>
                </div>
                <div>
                    <p>From $1299 or $54.12/mo. for 24 mo.*</p>
                </div>
            </div>

            <div class="storage-card">
                <div>
                    <strong>1TBÂ²</strong>
                </div>
                <div>
                    <p>From $1499 or $62.45/mo. for 24 mo.*</p>
                </div>
            </div>
        </div>
    </div>



@endsection

