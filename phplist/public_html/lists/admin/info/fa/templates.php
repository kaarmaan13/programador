<p>
در اینجا می‌توانید الگوهایی را تعریف کنید که هنگام فرستادن ایمیل به فهرست‌ها به کار گرفته شوند. یک الگو یک برگه HTML است که جایی در آن   <i>جا نگهدار</i> <b>[CONTENT]</b> آمده است.
 این همانجایی است که متن ایمل درج خواهد شد.
</P>
<p>
علاوه بر  [Content]، می‌توانید [FOOTER] و  [SIGNATURE]  را هم اضافه کنید، تا اطلاعات پابرگ و امضای پیام هم درج شوند. البته این دو اختیاری هستند.
</p>
<p>
تصویرهای الگویتان در ایمیلها هم خواهند آمد. اگر تصویرهایی را به محتوای پیامهایتان اضافه میکند (هنگام فرستادن)، لازم است که از URL کامل برای آدرس دهی استفاده کنید، این تصویرها به ایمیل شما پیوست نمی‌شوند.
</p>
<p><b>ردگیری کاربر</b></p>
<p>
برای آسانسازی  ردگیری کاربران، میتوانید [USERID] را به الگویتان اضافه کنید که با یک شناسه برای هر کاربر جایگزین میشود. البته تنها هنگام فرستادن ایمیل به صورت HTML به درستی کار خواهد کرد. باید یک URL تنظیم کنید که شناسه را دریافت کند. یا به جای اینکار می‌توانید ردگیری کاربر ساخته شده در<?php echo NAME?> را به کار بگیرید. برای اینکار [USERTRACK] را به الگوی خود اضافه کنید. یک لینک نامرئی به ایمیل اضافه میشود که رد دیده شدن ایمیل را ثبت کند.</p>
<p><b>تصویرها</b></p>
<p>
هر تصویری که ارجاع به آن با "http://" آغاز نشود باید برای پیوست شدن به ایمیل بارگذاری شود. توصیه میشود که تنها از تعداد کمی تصویر کوچک استفاده کنید. اگر الگویتان را بارگذاری کنید میتوانید تصویرها را اضافه کنید. ارجاع به تصویرهای ضمیمه شده باید از همان دایرکتوری باشد مانند 
&lt;img&nbsp;src=&quot;image.jpg&quot;&nbsp;......&nbsp;&gt; و نه &lt;img&nbsp;src=&quot;/some/directory/location/image.jpg&quot;&nbsp;..........&nbsp;&gt;</p>
