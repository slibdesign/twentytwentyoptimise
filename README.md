# Twenty Twenty Optimise Plugin :zap:

## Description
:rainbow: A WordPress plugin to improve the page load speed of the seven most popular WordPress themes.

## Themes Supported
* [Twenty Twenty-Three](https://en-gb.wordpress.org/themes/twentytwentythree/)
* [Twenty Twenty-Two](https://en-gb.wordpress.org/themes/twentytwentytwo/)
* [Twenty Twenty-One](https://en-gb.wordpress.org/themes/twentytwentyone/)
* [Twenty Twenty](https://en-gb.wordpress.org/themes/twentytwenty/)
* [Twenty Nineteen](https://en-gb.wordpress.org/themes/twentynineteen/)
* [Twenty Seventeen](https://en-gb.wordpress.org/themes/twentyseventeen/)
* [Twenty Sixteen](https://en-gb.wordpress.org/themes/twentysixteen/)

_The plugin will only work with a parent theme and it will not work with a child theme_

### Installation Guide
1. Setup [WP Engine](https://wpengine.com) web hosting for a WordPress website
2. Configured nameservers with [DNS Made Easy](https://dnsmadeeasy.com) using the server IP as the A Record
3. Activated the [Twenty Twenty-Three WordPress theme](https://en-gb.wordpress.org/themes/twentytwentyone/) in the WordPress Dashboard
4. Downloaded the Twenty Twenty Optimisse Plugin from GitHub and activated the plugin
5. Removed other plugins from the WordPress dashboard
6. Turned on the Twenty Twenty Optimise Plugin settings (screenshot below)

#### Dashboard Settings Preview
![Settings Preview In WordPress Dashboard](https://github.com/slibdesign/twentytwentyoptimise/blob/master/screenshot/twentytwentyoptimisewppluginscreenshot.png)

#### Test Parameters

**Test #1** Plugin installed on [https://wpspeedupoptimisation.com](https://wpspeedupoptimisation.com)

**Test #2** Plugin not installed on [https://wpspeedupoptimisation.com](https://wpspeedupoptimisation.com)

**Test #3** Plugin not installed, generic hosting provider, standard nameservers [http://www.wpstandardspeed.com](http://www.wpstandardspeed.com)

__The lowest score for Desktop or Mobile Google Page Speed Insights score is recorded in the table below__

##### Twenty Twenty Three

Test #1  | Test #2 | Test #3 | Max. Improvement
----------------- | -------------------- | ----------------------- | -----------------------
[100/100 Page Speed Insights](https://wpspeedupoptimisation.com/performance-pngs/2023/google-mobile.png) | [100/100 Page Speed Insights](https://wpspeedupoptimisation.com/performance-pngs/2023/vanilla/google-mobile.png) | [91/100 Page Speed Insights](https://wpspeedupoptimisation.com/performance-pngs/2023/standard/google-mobile.png) | :heavy_check_mark: 9%
[73 ms Pingdom](https://wpspeedupoptimisation.com/performance-pngs/2023/pingdom.png) | [127 ms Pingdom](https://wpspeedupoptimisation.com/performance-pngs/2023/vanilla/pingdom.png) | [429 ms Pingdom](https://wpspeedupoptimisation.com/performance-pngs/2023/standard/pingdom.png) | :heavy_check_mark: 314 ms
[139 ms GTMetrix](https://wpspeedupoptimisation.com/performance-pngs/2023/gtmetrix.png) | [156ms GTMetrix](https://wpspeedupoptimisation.com/performance-pngs/2023/vanilla/gtmetrix.png) | 495 ms GTMetrix | :heavy_check_mark: 356 ms

##### Twenty Twenty Two

Test #1  | Test #2 | Test #3 | Max. Improvement
----------------- | -------------------- | -------------------- | -------------------- 
94/100 Page Speed Insights | 92/100 Page Speed Insights | 89/100 Page Speed Insights | :heavy_check_mark: 5%
113 ms Pingdom | 149 ms Pingdom | 450 ms Pingdom | :heavy_check_mark: 337ms
225 ms GTMetrix | 195 ms GTMetrix | - | -

##### Twenty Twenty One

Test #1 | Test #2 | Test #3 | Max. Improvement
----------------- | -------------------- | -------------------- | --------------------
100/100 Page Speed Insights | 100/100 Page Speed Insights | 85/100 Page Speed Insights | :heavy_check_mark: 15%
132 ms Pingdom | 124 ms Pingdom | 460 ms Pingdom Pingdom | :heavy_check_mark: 328 ms
163 ms GTMetrix | 452 ms GTMetrix | - | -

##### Twenty Twenty 

Test #1 | Test #2 | Test #3 | Max. Improvement
----------------- | --------------------| --------------------| --------------------
100/100 Page Speed Insights | 99/100 Page Speed Insights | 88/100 Page Speed Insights | :heavy_check_mark: 12%
98 ms Pingdom | 157 ms Pingdom | 352 ms Pingdom | :heavy_check_mark: 254 ms

##### Twenty Nineteen

Test #1 | Test #2 | Test #3 | Max. Improvement
----------------- | -------------------- | -------------------- | --------------------
100/100 Page Speed Insights | 100/100 Page Speed Insights | 98/100 Page Speed Insights | :heavy_check_mark: 2%
94 ms Pingdom | 94 ms Pingdom | 381 ms Pingdom | :heavy_check_mark: 287 ms

##### Twenty Seventeen

Test #1 | Test #2 | Test # 3 | Max. Improvement
----------------- | -------------------- | -------------------- | --------------------
100/100 Page Speed Insights | 91/100 Page Speed Insights | 76/100 Page Speed Insights | :heavy_check_mark: 24% 
86 ms Pingdom | 93 ms Pingdom | 431 ms Pingdom | :heavy_check_mark: 345 ms

##### Twenty Sixteen

Test #1 | Test #2 | Test #3 | Max. Improvement
----------------- | -------------------- | -------------------- | --------------------
91/100 Page Speed Insights | 91/100 Page Speed Insights | 76/100 Page Speed Insights | 15% :heavy_check_mark:
88 ms Pingdom | 100 ms Pingdom  | 517 ms Pingdom | :heavy_check_mark: 429 ms

#### Trounbleshooting
_Occasionally, a WordPress Plugin may not work as expected. The plugin disables default WordPress features to improve the page load speed and therefore it may have an adverse impact on your website. Always take a backup of your WordPress_

#### Last Updated
[Ben Llewellyn](https://www.slibdesign.com) updated the plugin to WordPress version 6.1.1.





