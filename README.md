Copyright (C) 2012 by Kris

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

About
	Hide parts of the content of your posts or pages until bitcoinCAPTCHA challenge is completed by surrounding it with [bitcoinCAPTCHA] and [/bitcoinCAPTCHA] shortcode.

Installation:
	1. Replace bitcoin address in bitcoincaptcha.php with your own.
	2. Upload `bitcoincaptcha` folder to the `/wp-content/plugins/` directory
	3. Activate the plugin through the 'Plugins' menu in WordPress
	4. Place `[bitcoinCAPTCHA]` and `[/bitcoinCAPTCHA]` in your posts and pages
	5. You can also set the text of the unlock link (this will show bitcoinCAPTCHA and users can pay to read) by passing the parameter "unlocklink" like this: [bitcoinCAPTCHA unlocklink="Pay to Read"]. In this case the text of the unlock link would be "Pay to Read".