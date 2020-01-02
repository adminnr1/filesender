
___

# Release 2.14
Release date: 28 Dec 2019.

## Distribution
Source snapshots are attached to this announcement and the git tag filesender-2.14 contains the base that these snapshots were created from.

## Installation
Documentation is available at http://docs.filesender.org/v2.0/install/

## Upgrade Notes
Version 2.x breaks compatibility with version 1.x. We recommend a fresh installation to version 2.x of FileSender.

## Major changes since 2.13
Execution of scripts/upgrade/database.php is not required.
There are no changes in the templates directory.

This release will use a web assembly implementation of PBKDF2 on Edge and IE11 which lack the capability in their WebCrypto implementation. This is only active in those two browsers in key_version=1. Files uploaded using Edge and IE11 in key_version=1 will be downloadable in other browsers and vice versa. This update should be of particular interest to those who have been using key_version=0 in order to support these specific browsers. This has been tested in IE11 and Edge on Windows 10. Some updates have been merged for IE11 comparability.

An auditlogs query was split into two queries in order to work across mariadb and postgresql and versions of each.

## Configuration changes
Added crypto_pbkdf2_dialog_custom_webasm_delay which allows dialogs to still appear before the webasm code is run which might make things unresponsive on some browsers. This is only effective when using webasm pbkdf2 which is itself only done on IE11 and Edge when key_version=1.
___

# Release Version 2.13
Release date: 2 Dec 2019.

## Distribution
Source snapshots are attached to this announcement and the git tag filesender-2.13 contains the base that these snapshots were created from.

## Installation
Documentation is available at http://docs.filesender.org/v2.0/install/

## Upgrade Notes
Version 2.x breaks compatibility with version 1.x. We recommend a fresh installation to version 2.x of FileSender.

## Major changes since 2.12
Execution of scripts/upgrade/database.php is not required.
There are no changes in the templates directory.

This update fixes some javascript issues with IE11 (#705) and makes the auditlog cron query work cross database (#704).

## Configuration changes
None.
___

# Release Version 2.12
Release date: 28 Nov 2019.

## Distribution
Source snapshots are attached to this announcement and the git tag filesender-2.12 contains the base that these snapshots were created from.

## Installation
Documentation is available at http://docs.filesender.org/v2.0/install/

## Upgrade Notes
Version 2.x breaks compatibility with version 1.x. We recommend a fresh installation to version 2.x of FileSender.

## Major changes since 2.11
After this release new contributions should be made against the development branch in git. When the next official release is made, the collective changes between development and master will be committed to master and a new tag generated in master. This has the outcome that master will always be the last officially released code and development will be updates made to that master code that has is not yet part of an official release.

Execution of scripts/upgrade/database.php is required. After database.php is executed the script in scripts/upgrade/explicit/upgrade-2.11-to-2.12-after-database-guestsexpire.php should be executed to more explicitly enable guests which do not expire.

There are changes in the templates directory, specifically the guests_page.php and admin/testing.

The PBKDF2 algorithm is commonly used to generate a cryptographic key from a user supplied password. This algorithm has a configurable number of iterations that are be performed as part of the process to make the key. The larger the number of iterations the longer it takes to generate a key from a password. This also implies that it takes longer to guess a password because each guess requires computational effort. Instead of configuring the number of iterations directly a new parameter was added crypto_pbkdf2_expected_secure_to_year which can be between 2020 and 2030 and will override your setting for encryption_password_hash_iterations_new_files which is the number of PBKDF2 iterations to perform. This parameter is saved for each transfer so you can alter it and existing files can still be downloaded and decrypted.

A default value for crypto_pbkdf2_expected_secure_to_year of 2027 was chosen to obtain as much security as possible with a reasonably low delay. A site admin can visit admin/testing to see how long the PBKDF2 delay is for various year settings in their browser.

Due to the PBKDF2 delay taking from a few seconds to 30 seconds depending on browser and the specification of the PC a new dialog was added which is shown by default crypto_pbkdf2_dialog_enabled and will display a dialog to the user when PBKDF2 is occurring so that the user does not conclude that the lack of activity means that the system has stalled.

Many translation updates. Estonian is now imported into et_EE. Polish is imported into pl. An update to the single quoting regex in scripts/language/common.php thanks to @Phaze-III #680.
New scripts to compare two php lang files, convert from poeditor json lang format to php format, and download and import lang files directly from poeditor have been added #687. This poeditor import script gives pull requests like #691. All languages have been reimported from poeditor along the way and again just before the release.

Better handling of guests who do not expire. Such guests now have an expires time of null in the database and many issues where transfers from guests who should not expire but had an expires time in the past have been resolved. See #683

A nicer dialog is now shown when users already have the most guests the system allows them to have #684

The python REST client now takes the default number of days valid for a transfer from the server at the time it is downloaded. Thanks to @peter- for the original pull request that was updated slightly and merged in with #682

## Configuration changes
Default values for these should be fine. See https://docs.filesender.org/v2.0/admin/configuration/ for details.

crypto_pbkdf2_expected_secure_to_year
crypto_pbkdf2_dialog_enabled
crypto_pbkdf2_delay_to_show_dialog

___

# Release Version 2.11
Release date: 4 Nov 2019.

## Distribution
Source snapshots are attached to this announcement and the git tag filesender-2.11 contains the base that these snapshots were created from.

## Installation
Documentation is available at http://docs.filesender.org/v2.0/install/

## Upgrade Notes
Version 2.x breaks compatibility with version 1.x. We recommend a fresh installation to version 2.x of FileSender.

## Major changes since 2.10
Execution of scripts/upgrade/database.php is not needed.
No files in the templates directory were updated.

Cryptographic keys are now cached and reused for all FileSender chunks in an upload and download. This will have a larger performance improvement for more secure user supplied password handling where the security is partially based on the time required to convert a password into a key, for example, using very high PBKDF2 hash iteration values. See #671 for details on the caching.

Improved handling of listing that include both GCM and CBC files on the same page, for example the my transfers page.

If an encrypted file has disappeared from the back end storage and a user tries to download the file a message the the file is not found is shown instead of 'bad password' which may have lead a user to frustration trying passwords many times for such files.

## Configuration changes
None.

___

# Release Version 2.10
Release date: 31 Oct 2019.

## Distribution
Source snapshots are attached to this announcement and the git tag filesender-2.10 contains the base that these snapshots were created from.

## Installation
Documentation is available at http://docs.filesender.org/v2.0/install/

## Upgrade Notes
Version 2.x breaks compatibility with version 1.x. We recommend a fresh installation to version 2.x of FileSender.

## Major changes since 2.9
Execution of scripts/upgrade/database.php is not needed.
No files in the templates directory were updated.

On the database site: a raw reference to the 'recipients' table has been converted to use the getDBTable() to cover table name case and prefixing. A query in AuditLog::cleanup() was updated to work on more versions of MariaDB.
Update to tests to see if a foreign key exists used by upgrade/database.php.

Scoping of filesender object is always done from top level in crypto_app. DBConstantPasswordEncoding is now actively testing CGI variables for rubbish values. DatabaseUpsert and EpochType produce less logging clutter. Small update to JSON log file generation.

## Configuration changes
The variable terasender_advanced has been added to ConfigDefaults.php to cover cases where it is not set explicitly in config.php.
___

# Release Version 2.6
Release date: 16 April 2019.

## Errata
To support slower connections one might like to set the config terasender_worker_xhr_timeout to a higher value as has been done in github already. This has been set for future releases https://github.com/filesender/filesender/pull/543/files

$config['terasender_worker_xhr_timeout'] = 3600000;

## Distribution
Source snapshots are attached to this announcement and the git tag filesender-2.6 contains the base that these snapshots were created from.

## Installation
Documentation is available at http://docs.filesender.org/v2.0/install/

## Upgrade Notes
Version 2.x breaks compatibility with version 1.x. We recommend a fresh installation to version 2.x of FileSender.

## Major changes since 2.5
This is mostly a maintenance and bugfix release.

Some new functionality was also added mostly to address issues and extensions to core functionality that will improve the overall user experience. These will be described first and include:

Support for creating archives in tar will improve the user experience for Linux and OSX users #325
This was created and brought in with #513

An interesting method to work out the content length header using the library and underlying data size to calculate it with minimal disk IO #514

That same method can be applied with a little mallet usage on the zip64 front too #516

An upload directory button will give the user a good hint that they can do this if they want. #372
This is addressed in #529 It is only enabled in Firefox and Chrome as it is browser dependent.

Since the database.php update script requires some extra privileges I created a new db_username_admin and password config key to allow the script to connect as an elevated user. #520

The following is a list of bugfixes and maintenance updates;

Inspected and merged jquery update #467

I created a patch to prevent the password too short drop down from appearing when it shouldn't after
you type a long enough password #462

Inspected and merged a file name length patch to the transfers table on the my transfers page #469

pull 441 was created by peter- to allow the get_a_link option to have effect when it is set to default=true and available=false. The available setting being false should make modification to the option not available to the user and the default choice from the system admin be in use.

I created and merged 471 to address the same problem as 441 without needing to perform additional checks to the javascript for the default setting. While there is more setup for 471 it allows the client side javascript to be simpler and avoids having to check the current and default options all the time when referencing get_a_link. This is important as simpler client checks will likely lead to them being correct without explicit programmer care.

The auditlog dialog on my transfers page no longer shows a scrollbar. This is to address #446 #473

Merged the remaining things from PR 158 through PR 474 which relates to page caching. #474

I raised the issue 472 which allows the default crypto key version to be set from config.php. This will help sites which wish to support IE11 to do so while other sites can enjoy the added security of using deriveKey(). #472

The reported issue of IE11 and the new key version #452 was resolved by allowing the key version to be set in the config.php to allow compatibility to be set by the admin #475 and documented here #487 There can be no direct resolution as IE11 lacks the deriveKey() API call so can not support the newer more secure key derivation funciton (version 1).

Even when the language selector is enabled by the sys admin with a config.php key, if the user has no explicit existing language selected then the selector would not show up. #477 #479 #480

To make the language selection option more obvious I moved the actions to the bottom of the my profile page. #478 #481

Having new menu items can cause problems depending on how many menu items are shown and how verbose a language is in it's description of the button text. #431
This lead to the above issues 477 to make the user profile language selector visible and fix issues there. The optional language selector that was in the menu bar has been moved out of the menu to above it. This makes it far less likely to disappear depending on language selection which is a big bug. #484 The user profile page now also allows you to access the privacy information page which gives a second way to access this information. With 2 ways to get there the menu item is not the only path to it any more. #482

to allow de locale to show the right menu items I have made the page 900px wide, up from 800px. This was a trade off instead of rewriting the menu code right at this time. #485

Selecting a language on the profile page will now also set the language selector in the menu to that selection to avoid confusion. #490

The help_url and about_url have stale documentation #420
which lead to renaming help_url to support_email #491 and updating a final reference to the old help_url #492

It was reported that php 7.0 is no longer a supported version of php #466 This moved the CI to using php 7.2. This required an update to the simplesamlphp use by the CI and a move to using the phpunit version brought in inside the vendor directory so that the phpunit version is compatible with the selenium used. #486 And the documentation is now updated to suggest php 7.2

It was reported that a spirited user might like to mangle the client side form in order to upload a file without checking the AUP checkbox. #440 I created and merged a server side recheck to catch such activity. #493

A link in the file downloaded email was wrongly encoded #465 which has been fixed #494

The subject in some translated emails was not being properly set #417 resulting in a documentation update https://github.com/filesender/filesender/pull/495/files and a changed value on poeditor for the dutch language.

Making can_only_send_to_me mandatory did not work with guest vouchers. If the option was true by default
but able to be set by the user then this were ok, it was only a bad workflow if the option was mandatory. #460 This was resolved with the creation and merge of #496

The subject line was not set correctly for emails sent to Dutch users. #417 Digging into the code I discovered that this was due to translating the subject: keyword to onderwerp
in the lauguage translations. The docs are updated, the Dutch tranlations partly updated for testing and
have been independently updated and verified. I have also mailed filesender-dev about the issue to reach
other translators.

The list of mandatory options that can be sent to the client has been expanded and a bad interaction where if get_a_link was a mandatory option then the file encryption part of the upload page was not available has been fixed. #497 This relates to #439

Expiration date is not correct when using Dutch language #436
after digging into the code and working out what was causing the issue the first move was a documentation improvement #499

Dutch translations
  old as of march 2019
    datetime_format = d/m/J H:m:s  
    date_foramt = d/m/Y            
    dp_date_format = dd-mm-yy 

new
    $lang['date_format'] = 'd-m-Y';
    $lang['datetime_format'] = 'd-m-Y H:m:s';
    $lang['dp_date_format'] = 'dd-mm-yy';

German as at march 2019
    date_format = d.m.Y 
 dp_date_format = dd.mm.yy 
datetime_format = d.m.Y H:i:s

Italian  as at march 2019
    date_format = d/m/Y 
 dp_date_format = dd/mm/yy 
datetime_format = d/m/Y H:i:s 

Further to this I moved to using strftime which offers some locale support in the date formatting. Dates are now also sent to the browser as integers and parsed client side to allow date formats to be different on the server and in specific UI elements. #500

Bringing in language translations #502 #503 #504

Languages that were on poeditor but not in github have been brought in #507

I was looking to automate the download from poeditor to FileSender step and found that currently the php export doesn't work in the poeditor API. This has been reported to poeditor. The response from poeditor is to export as non php and convert. https://poeditor.com/docs/api#projects_export

Some raw whitespace was causing openbox unicode characters to display #438 I can see why the openbox characters were being set and they are now filtered back to spaces. #508

The date format is set in the language translations. It is useful for a site to be able to override this in config.php
and not have to worry about their change when they update filesender. #299
This was addressed in PR #509

The admin/users sub page has been refreshed to work again #511

A warning was placed to help osx users handle zip64 files #512 This relates to #295

Debian packaging files were requested in #330 After some digging I found some fairly old files that were probably used to generate old deb files and I have imported these older files to help with efforts to package #510

The handling for multiple subject lines in emails was not disregarding empty subject lines in favor of other lines #515 This is fixed with #517

Having a typo in an element access could stop the cron job from completing because of an exception being thrown. #301 This was fixed with #518

The stats information was preventing users who are on MySQL from being able to view the page. #464 To apply a more complete fix for this issue I broke out the many items that were bring queried into dbconstants and referenced them from statlog. This simplified the query in the web page and also helps to make it execute across databases by separating the data query from the presentation. #521 The is_encrypted view column has been made a real column in the base table now. There is little point in taking a bool from php and turning it into part of the additional_attributes string only to query for it again with a nasty LIKE clause. #523

If you set the chunk_size but forget to set crypted_chunk_size to match then you get a strange error. #397 This was fixed with #524

xhr timeout on wifi dropout. #217 the robustness was improved with the below which also detects a case when terasender may not successfully launch web workers. #527

The following is more informational at this stage. I hope to address it in an upcoming update. Investigation into an issue, originally reported by SURFnet, where iphones do not show a bad password dialog. I found that safari on macos also doesn't do this. #455 It seems from digging into it that AES-CBC on safari always succeeds. I found that the error features were called when testing with AES-GCM so delayed further testing on the issue until the move to using GCM in webcrypto has occurred.

## Configuration changes
Two new optional config parameters can be used to provide a user to login to the database that will be used by the database.php upgrade script. This allows the admin user to have more privilege than the regular db_username has. See the installation page https://docs.filesender.org/v2.0/install/ in the MySQL database setup for details. New options db_username_admin and db_password_admin.

encryption_key_version_new_files (defaults to latest version available in release) to set a specific version number for encryption of new files. Mostly to allow older software like IE11 to continue to work with the site. This should not need to be explicitly set unless you want to force an old version to be used.

Two timeouts to detect xhr failures and failure to start web workers in general. These should not need to be explicitly set.
terasender_worker_xhr_timeout
terasender_worker_start_must_complete_within_ms

tmp_path was added for code to migrate to using for storing temporary files.

The help_url parameter was removed and replaced with the more specific support_email

directory_upload_button_enabled (default: true) was added to allow a select directory button on the upload page for supported browsers.

transfer_options_not_available_to_export_to_client was added to specifically select options which are not available (not shown to user) which should be exported to the client so the javascript can operate as though those options are explicitly set to the default values from the server. This should not need to be explicitly set.
___

# Release Version 2.5
Release date: 27 December 2018.

## Distribution
Source snapshots are attached to this announcement and the git tag filesender-2.5 contains the base that these snapshots were created from.

## Installation
Documentation is available at http://docs.filesender.org/v2.0/install/

## Upgrade Notes
Version 2.x breaks compatibility with version 1.x. We recommend a fresh installation to version 2.x of FileSender.

## Major changes since 2.4
The addition of new optional aggregate statistics. These do not contain information that can identify any specific user but instead contain information about the overall statistics for given periods of time such as the mean or maximum file size for a given time period.

Time periods are in the range from 15 minutes, hourly, daily, weekly, monthly etc. Statistics are gathered for each interval that is active. So for example if it is currently 10:30am then at 11:00 the hour interval will change to the one for the 11-12 hour on the same day.

When enabled, graphs for aggregate statistics can be seen by accessing the link at the bottom of the about page. To enable aggregate statistics set aggregate_statlog_lifetime to true. Access is also restricted in the config with the can_view_aggregate_statistics setting which has the same format as the admin config and allows you to select which users can see aggregate statistics.

There is support for exporting aggregate statistics and emailing them periodically. This is disabled by default because aggregate_statlog_send_report_days has a setting of zero by default. This can be enabled with the aggregate_statlog_send_report_days and aggregate_statlog_send_report_email_address config settings. The information which is emailed comes from the AggregateStatisticMetadata and AggregateStatistic tables which do not contain any information which can identify individual users.

generateUID() has been updated through PR 190.

Interesting Information about source code changes:

To support aggregate statistics new upsert support code was added to FileSender. An upsert (update or insert) allows an insert or update to happen as a single atomic operation. This avoids the need for transactions to help perform the same task and allows multiple clients to upsert at the same time without creating issues around many clients trying to insert because an initial update had failed.

Storing constants in the database is now supported by new code in classes/data/constants contains a new DBConstant class that supports storing ID-string number to string mappings in the database. This extends to mirroring the mapping in PHP so that tables can store constants broken out into tables and reference the strings using their corresponding ID numbers. Having DBConstant subclasses allows the PHP code to reference ID numbers without needing to query the database to find out their current values. The mapping should be identical in PHP and the database for these constant tables. Database migration is supported to add these tables and also extend then with new values should the need arise. Note that you should not delete constants from these tables or the PHP code.

## Configuration changes
aggregate_statlog_lifetime defaults to false to disable these statistics. Set this to true to capture stats.

aggregate_statlog_send_report_days defaults to 0 to disable this report by default. Set this to the number of days between reports.

aggregate_statlog_send_report_email_address is set to '' by default. Set this to the email address you wish to send the aggregate statistics to.
___

# Release Version 2.4
Release date: 6 October 2018.

## Distribution
Source snapshots are attached to this announcement and the git tag filesender-2.4 contains the base that these snapshots were created from.

## Installation
Documentation is available at http://docs.filesender.org/v2.0/install/

## Upgrade Notes
Version 2.x breaks compatibility with version 1.x. We recommend a fresh installation to version 2.x of FileSender.

## Major changes since 2.3
My profile page is now enabled in default settings. Storage quotas now handle zero as unlimited (as was always documented). Improvements to admin/configuration documentation. A bug in the menu was fixed.

A new script to reformat the code was added (reformat-code.sh) and documentation in dev/formatting/index.md. This should help the code compliant with PSR1 and PSR2 (https://www.php-fig.org/psr/psr-2/). Formatting only changes should be merged with "merge" and not squash and merge so that the line changes are shown as being made by a formatting script in a git blame output. Note that git blame can be applied more than once to move back past the formatting only change and see the last change a human has made to lines.

CI has been updated to run against MariaDB 10.0 to check against what is now the minimal recommended version (instead of 10.2). As MariaDB 10.0 does not like views with subselects a work around for such cases was added in the code, see getPrimaryViewDefinition() for details. A fix for CAST to work on MySQL as well as MariaDB. FK creation has been abstracted out into a new class and updated to work better on MySQL 5.x. Updates to the cron script for MariaDB 10.0+ were made, other updates to the database migration script.

## Configuration changes
No new settings.
___
