Apache works out of the box. Kirby ships with a `.htaccess` file that contains all necessary rewrite rules and security settings, so there's nothing to configure.

<info>
When copying files to a remote server via (S)FTP, make sure to copy the `.htaccess` file as well. By default, files starting with a dot are invisible in the filesystem, so make sure to enable the display of invisible files before copying.
</info>

If your site runs in a subfolder, you have to adjust the `RewriteBase` in the `.htaccess` file. See our (link: docs/guide/troubleshooting/installation text: installation troubleshooting guide) if links or the entire site break.
