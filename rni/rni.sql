-- phpMyAdmin SQL Dump
-- version 2.10.0.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 08, 2008 at 03:05 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `securene_documentsystem`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_admin`
-- 

CREATE TABLE `tbl_admin` (
  `Ident` int(11) NOT NULL auto_increment,
  `username` varchar(100) NOT NULL default '',
  `password` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`Ident`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `tbl_admin`
-- 

INSERT INTO `tbl_admin` (`Ident`, `username`, `password`) VALUES 
(1, 'admin', 'admin');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_Admin_Menu`
-- 

CREATE TABLE `tbl_Admin_Menu` (
  `Ident` int(11) NOT NULL auto_increment,
  `MainMenu` varchar(255) NOT NULL default '',
  `SubMenu` text NOT NULL,
  `MenuLink` text NOT NULL,
  `MenuLinkSite` text NOT NULL,
  `CurrentPReference` varchar(255) NOT NULL default '',
  `PreviousPreference` varchar(255) NOT NULL default '',
  `MenuType` varchar(255) NOT NULL default '',
  `MainMenuLink` varchar(255) NOT NULL default '',
  `MainMenuLinkSite` text NOT NULL,
  `Status` enum('Active','InActive','Deleted') NOT NULL default 'InActive',
  `Order_id` int(11) NOT NULL default '0',
  `parent_id` varchar(200) NOT NULL default '',
  `DisplayTitle` varchar(255) default NULL,
  PRIMARY KEY  (`Ident`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

-- 
-- Dumping data for table `tbl_Admin_Menu`
-- 

INSERT INTO `tbl_Admin_Menu` (`Ident`, `MainMenu`, `SubMenu`, `MenuLink`, `MenuLinkSite`, `CurrentPReference`, `PreviousPreference`, `MenuType`, `MainMenuLink`, `MainMenuLinkSite`, `Status`, `Order_id`, `parent_id`, `DisplayTitle`) VALUES 
(9, 'Manage Menus', 'Menu List', 'menu_list.php', '', '2', '2', 'Admin', '', '', 'Active', 6, '', ''),
(11, 'Documents', 'Add Document,Documentlist', 'adddocument.php,documentlist.php', '', '2', '2', 'Admin', '', '', 'Active', 4, '', 'Documents'),
(68, 'Catagories', 'Category List, Add Category,Add Accessory,Accessory List', 'categorylist.php,add_category.php,add_cat_accessaries.php,cat_accessarieslist.php', '', '2', '2', 'Admin', '', '', 'InActive', 1, '', 'Catagories'),
(12, 'Member', 'Grouplist,Add Member,Member List, Groupwise Member List', 'grouplist.php,add_member.php,userlist.php,groupwisememberlist.php', '', '2', '2', 'Admin', '', '', 'Active', 2, '', ''),
(13, 'Vendors', 'Vendors List,Add vendor', 'vendorlist.php,add_vendor.php', '', '1', '1', 'Admin', '', '', 'InActive', 3, '', NULL),
(67, 'Report', 'Userwise Report,Documentwise Report ,Groupwise Report', 'userwisereport.php,documentwisereport.php,groupwisereport.php', '', '2', '2', 'Admin', '', '', 'Active', 5, '1', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_documents`
-- 

CREATE TABLE `tbl_documents` (
  `id` int(11) NOT NULL auto_increment,
  `documentname` varchar(255) NOT NULL,
  `doc_filename` varchar(255) NOT NULL,
  `doc_OriginalName` varchar(255) NOT NULL,
  `doc_description` text NOT NULL,
  `grouplist` varchar(255) NOT NULL,
  `userlist` varchar(255) NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `tbl_documents`
-- 

INSERT INTO `tbl_documents` (`id`, `documentname`, `doc_filename`, `doc_OriginalName`, `doc_description`, `grouplist`, `userlist`, `created_on`) VALUES 
(4, 'text doc 2', '4.gif', 'mail.gif', '<span style=\\"\\" arial;=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" font-weight:=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" bold;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\">Admin should also be able to send\r\n      a reminder for those who did not read and initial certain documents to do\r\n      so<br></span><span style=\\"\\" arial;=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" font-weight:=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" bold;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\">Admin should also be able to send\r\n      a reminder for those who did not read and initial certain documents to do\r\n      so<br></span><span style=\\"\\" arial;=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" font-weight:=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" bold;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\">Admin should also be able to send\r\n      a reminder for those who did not read and initial certain documents to do\r\n      so<br></span><span style=\\"\\" arial;=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" font-weight:=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" bold;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\">Admin should also be able to send\r\n      a reminder for those who did not read and initial certain documents to do\r\n      so<br></span><span style=\\"\\" arial;=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" font-weight:=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" bold;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\">Admin should also be able to send\r\n      a reminder for those who did not read and initial certain documents to do\r\n      so<br></span><span style=\\"\\" arial;=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" font-weight:=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" bold;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\">Admin should also be able to send\r\n      a reminder for those who did not read and initial certain documents to do\r\n      so<br></span><span style=\\"\\" arial;=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" font-weight:=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\" bold;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\=\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\">Admin should also be able to send\r\n      a reminder for those who did not read and initial certain documents to do\r\n      so</span><br>   ', '1|11|13|', '1|5|6|11|12|20|21|', '2008-01-28'),
(6, 'text doc', '6.rtf', 'Document.rtf', 'text doc    ', '1|2|11|', '1|5|12|', '2008-01-28'),
(7, 'quotes', '7.xls', 'quotes.xls', 'quotes', '', '10|8|', '2008-01-28');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_documentStatus`
-- 

CREATE TABLE `tbl_documentStatus` (
  `id` int(11) NOT NULL auto_increment,
  `doc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

-- 
-- Dumping data for table `tbl_documentStatus`
-- 

INSERT INTO `tbl_documentStatus` (`id`, `doc_id`, `user_id`, `Status`) VALUES 
(1, 1, 5, 'Read'),
(3, 1, 5, 'Read'),
(4, 1, 5, 'Read'),
(5, 1, 5, 'Read'),
(6, 1, 5, 'Read'),
(7, 1, 5, 'Read'),
(8, 1, 5, 'Read'),
(9, 1, 5, 'Read'),
(10, 1, 5, 'Read'),
(11, 1, 5, 'Read'),
(12, 1, 5, 'Read'),
(13, 1, 5, 'Read'),
(14, 1, 5, 'Read'),
(19, 1, 1, 'Read'),
(20, 4, 12, 'Read'),
(63, 6, 5, 'Read'),
(27, 4, 6, 'Read'),
(28, 1, 5, 'Read');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_EMail_Template_Files`
-- 

CREATE TABLE `tbl_EMail_Template_Files` (
  `Ident` int(11) NOT NULL auto_increment,
  `TemplateCode` varchar(50) NOT NULL default '',
  `TemplateName` varchar(50) NOT NULL default '',
  `HTMLTemplateFile` varchar(50) NOT NULL default '',
  `HTMLHeaderFile` varchar(50) NOT NULL default '',
  `HTMLFooterFile` varchar(50) NOT NULL default '',
  `TEXTTemplateFile` varchar(50) NOT NULL default '',
  `TEXTHeaderFile` varchar(50) NOT NULL default '',
  `TEXTFooterFile` varchar(50) NOT NULL default '',
  `HTMLFormat` enum('Yes','No') NOT NULL default 'Yes',
  `FromName` varchar(100) NOT NULL default '',
  `FromAddress` varchar(50) NOT NULL default '',
  `Subject` varchar(100) NOT NULL default '',
  `MailContent` text,
  `AddedDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `LastUpdated` datetime NOT NULL default '0000-00-00 00:00:00',
  `Status` enum('Active','InActive') NOT NULL default 'Active',
  `PossibleValues` text,
  PRIMARY KEY  (`Ident`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `tbl_EMail_Template_Files`
-- 

INSERT INTO `tbl_EMail_Template_Files` (`Ident`, `TemplateCode`, `TemplateName`, `HTMLTemplateFile`, `HTMLHeaderFile`, `HTMLFooterFile`, `TEXTTemplateFile`, `TEXTHeaderFile`, `TEXTFooterFile`, `HTMLFormat`, `FromName`, `FromAddress`, `Subject`, `MailContent`, `AddedDate`, `LastUpdated`, `Status`, `PossibleValues`) VALUES 
(3, 'REGISTER', 'Registration', '', '', '', '', '', '', 'Yes', 'Read & Initial System', 'Read & Initial System', 'Registration', '<div style=\\"border:10px solid #416693;width:750px;\\">\r\n    <table border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"750\\" style=\\"border:10px solid #afbccc;\\">\r\n          <tr>\r\n            <td background=\\"$path$images/mail-bg.gif\\" style=\\"background-repeat:repeat-x;\\" colspan=\\"2\\">\r\n               Document read and initial system\r\n            </td>\r\n          </tr>\r\n			<tr>\r\n			  <td class=\\"EmailFont\\" style=\\"PADDING-LEFT: 25px; PADDING-TOP: 10px\\" colspan=\\"2\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: tahoma,arial,helvetica,sans-serif\\">Dear <strong>$UserLogin$,</span></td>\r\n			</tr>\r\n			<tr>\r\n			  <td class=\\"EmailFont\\" style=\\"PADDING-LEFT: 25px; PADDING-TOP: 10px\\" colspan=\\"2\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: tahoma,arial,helvetica,sans-serif\\">Thank you for registering with read &amp; initial system.</span></td>\r\n			</tr>\r\n			<tr>\r\n			  <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 25px\\" width=\\"30%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\"><strong></strong></span></td>\r\n			  <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 5px\\" align=\\"left\\" width=\\"70%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\"></span></td>\r\n			</tr>\r\n			<tr>\r\n			  <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 25px; PADDING-TOP: 10px\\" width=\\"30%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\"><strong>Login ID :</strong></span></td>\r\n			  <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 5px; PADDING-TOP: 10px\\" align=\\"left\\" width=\\"70%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\">$UserLogin$</span></td>\r\n			</tr>\r\n			<tr>\r\n			  <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 25px\\" width=\\"30%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\"><strong>Password :</strong></span></td>\r\n			  <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 5px\\" align=\\"left\\" width=\\"70%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\">$Password$</span></td>\r\n			</tr>\r\n			<tr>\r\n            	<td colspan=\\"2\\" style=\\"padding:00px 10px 20px 20px;font-family:arial;font-size:12px;line-height:19px;\\"><p style=\\"margin:0px;\\">Regards,<br>\r\n            The Read & Initial system Team</p></td></tr>\r\n         	<tr>\r\n        </tr>\r\n    </table>\r\n</div>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Active', NULL),
(1, 'FORGET_PASSWORD', 'forgot password', '', '', '', '', '', '', 'Yes', 'Admin', 'Read & Initial System', 'Password Recovery', '<div style=\\"border:10px solid #416693;width:750px;\\">\r\n    <table border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"750\\" style=\\"border:10px solid #afbccc;\\">\r\n          <tr>\r\n            <td background=\\"$path$images/mail-bg.gif\\" style=\\"background-repeat:repeat-x;\\" colspan=\\"2\\">\r\n               Document read and initial system\r\n            </td>\r\n          </tr>\r\n			<tr>\r\n			  <td class=\\"EmailFont\\" style=\\"PADDING-LEFT: 25px; PADDING-TOP: 10px\\" colspan=\\"2\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: tahoma,arial,helvetica,sans-serif\\">Recovered Password is:</span></td>\r\n			</tr>\r\n\r\n			<tr>\r\n			  <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 25px\\" width=\\"30%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\"><strong>Password :</strong></span></td>\r\n			  <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 5px\\" align=\\"left\\" width=\\"70%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\">$Password$</span></td>\r\n			</tr>\r\n        <tr>\r\n            <td>&nbsp;</td>\r\n        </tr>\r\n         <tr>\r\n            <td colspan=\\"2\\" style=\\"padding:00px 10px 20px 20px;font-family:arial;font-size:12px;line-height:19px;\\"><p style=\\"margin:0px;\\">Regards,<br>\r\n            The Read & Initial system Team</p></td></tr>\r\n         <tr>\r\n        </tr>\r\n    </table>\r\n</div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Active', NULL),
(2, 'ACTIVATE', 'Account Activation', '', '', '', '', '', '', 'Yes', 'Read & Initial System', 'Read & Initial System', 'Activation', '<div style=\\"border:10px solid #416693;width:750px;\\">\r\n    <table border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"750\\" style=\\"border:10px solid #afbccc;\\">\r\n          <tr>\r\n            <td background=\\"$path$images/mail-bg.gif\\" style=\\"background-repeat:repeat-x;\\" colspan=\\"2\\">\r\n               Document read and initial system\r\n            </td>\r\n          </tr>\r\n			<tr>\r\n			  <td class=\\"EmailFont\\" style=\\"PADDING-LEFT: 25px; PADDING-TOP: 10px\\" colspan=\\"2\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: tahoma,arial,helvetica,sans-serif\\">Your account is approved by admin. For your records, your account information is:</span></td>\r\n			</tr>\r\n			<tr>\r\n			  <td class=\\"EmailFont\\" style=\\"PADDING-LEFT: 25px; PADDING-TOP: 10px\\" colspan=\\"2\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: tahoma,arial,helvetica,sans-serif\\">Thank you for registering with read &amp; initial system.</span></td>\r\n			</tr>\r\n			<tr>\r\n			  <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 25px\\" width=\\"30%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\"><strong></strong></span></td>\r\n			  <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 5px\\" align=\\"left\\" width=\\"70%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\"></span></td>\r\n			</tr>\r\n                    <tr>\r\n                      <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 25px; PADDING-TOP: 10px\\" width=\\"30%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\"><strong>Login ID :</strong></span></td>\r\n                      <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 5px; PADDING-TOP: 10px\\" align=\\"left\\" width=\\"70%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\">$UserLogin$</span></td>\r\n                    </tr>\r\n                    <tr>\r\n                      <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 25px\\" width=\\"30%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\"><strong>Password :</strong></span></td>\r\n                      <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 5px\\" align=\\"left\\" width=\\"70%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\">$Password$</span></td>\r\n                    </tr>\r\n         <tr>\r\n            <td colspan=\\"2\\" style=\\"padding:00px 10px 20px 20px;font-family:arial;font-size:12px;line-height:19px;\\"><p style=\\"margin:0px;\\">Regards,<br>\r\n            The Read & Initial system Team</p></td></tr>\r\n         <tr>\r\n        </tr>\r\n    </table>\r\n</div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Active', NULL),
(6, 'DEACTIVATE', 'Account DeActivation', '', '', '', '', '', '', 'Yes', 'Read & Initial System', 'Read & Initial System', 'DeActivation', '<div style=\\"border:10px solid #416693;width:750px;\\">\r\n    <table border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"750\\" style=\\"border:10px solid #afbccc;\\">\r\n          <tr>\r\n            <td background=\\"$path$images/mail-bg.gif\\" style=\\"background-repeat:repeat-x;\\" colspan=\\"2\\">\r\n               Document read and initial system\r\n            </td>\r\n          </tr>\r\n			<tr>\r\n			  <td class=\\"EmailFont\\" style=\\"PADDING-LEFT: 25px; PADDING-TOP: 10px\\" colspan=\\"2\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: tahoma,arial,helvetica,sans-serif\\">Your account is temporarily unapproved by admin.</span></td>\r\n			</tr>\r\n			<tr>\r\n			  <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 25px\\" width=\\"30%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\"><strong></strong></span></td>\r\n			  <td class=\\"EmailsubHeading\\" style=\\"PADDING-LEFT: 5px\\" align=\\"left\\" width=\\"70%\\"><span style=\\"FONT-SIZE: 10pt; FONT-FAMILY: Arial, Helvetica, Verdana, sans-serif\\"></span></td>\r\n			</tr>\r\n         <tr>\r\n            <td colspan=\\"2\\" style=\\"padding:00px 10px 20px 20px;font-family:arial;font-size:12px;line-height:19px;\\"><p style=\\"margin:0px;\\">Regards,<br>\r\n            The Read & Initial system Team</p></td></tr>\r\n         <tr>\r\n        </tr>\r\n    </table>\r\n</div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Active', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_groups`
-- 

CREATE TABLE `tbl_groups` (
  `id` int(11) NOT NULL auto_increment,
  `Value` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `tbl_groups`
-- 

INSERT INTO `tbl_groups` (`id`, `Value`) VALUES 
(1, 'group 2'),
(2, 'Group 1'),
(11, 'group 3'),
(12, 'group 4'),
(13, 'group 5');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_State`
-- 

CREATE TABLE `tbl_State` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `StateCode` varchar(5) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL default 'Inactive',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `StateCode` (`StateCode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

-- 
-- Dumping data for table `tbl_State`
-- 

INSERT INTO `tbl_State` (`ID`, `StateCode`, `Name`, `Status`) VALUES 
(1, 'AL', 'Alabama', 'Active'),
(2, 'AK', 'Alaska', 'Active'),
(3, 'AS', 'American Samoa', 'Active'),
(4, 'AZ', 'Arizona', 'Active'),
(5, 'AR', 'Arkansas', 'Active'),
(6, 'CA', 'California', 'Active'),
(7, 'CO', 'Colorado', 'Active'),
(8, 'CT', 'Connecticut', 'Active'),
(9, 'DE', 'Delaware', 'Active'),
(10, 'DC', 'District Of Columbia', 'Active'),
(11, 'FM', 'Federated States Of Micronesia', 'Active'),
(12, 'FL', 'Florida', 'Active'),
(13, 'GA', 'Georgia', 'Active'),
(14, 'GU', 'Guam', 'Active'),
(15, 'HI', 'Hawaii', 'Active'),
(16, 'ID', 'Idaho', 'Active'),
(17, 'IL', 'Illinois', 'Active'),
(18, 'IN', 'Indiana', 'Active'),
(19, 'IA', 'Iowa', 'Active'),
(20, 'KS', 'Kansas', 'Active'),
(21, 'KY', 'Kentucky', 'Active'),
(22, 'LA', 'Louisiana', 'Active'),
(23, 'ME', 'Maine', 'Active'),
(24, 'MH', 'Marshall Islands', 'Active'),
(25, 'MD', 'Maryland', 'Active'),
(26, 'MA', 'Massachusetts', 'Active'),
(27, 'MI', 'Michigan', 'Active'),
(28, 'MN', 'Minnesota', 'Active'),
(29, 'MS', 'Mississippi', 'Active'),
(30, 'MO', 'Missouri', 'Active'),
(31, 'MT', 'Montana', 'Active'),
(32, 'NE', 'Nebraska', 'Active'),
(33, 'NV', 'Nevada', 'Active'),
(34, 'NH', 'New Hampshire', 'Active'),
(35, 'NJ', 'New Jersey', 'Active'),
(36, 'NM', 'New Mexico', 'Active'),
(37, 'NY', 'New York', 'Active'),
(38, 'NC', 'North Carolina', 'Active'),
(39, 'ND', 'North Dakota', 'Active'),
(40, 'MP', 'Northern Mariana Islands', 'Active'),
(41, 'OH', 'Ohio', 'Active'),
(42, 'OK', 'Oklahoma', 'Active'),
(43, 'OR', 'Oregon', 'Active'),
(44, 'PW', 'Palau', 'Active'),
(45, 'PA', 'Pennsylvania', 'Active'),
(46, 'PR', 'Puerto Rico', 'Active'),
(47, 'RI', 'Rhode Island', 'Active'),
(48, 'SC', 'South Carolina', 'Active'),
(49, 'SD', 'South Dakota', 'Active'),
(50, 'TN', 'Tennessee', 'Active'),
(51, 'TX', 'Texas', 'Active'),
(52, 'UT', 'Utah', 'Active'),
(53, 'VT', 'Vermont', 'Active'),
(54, 'VI', 'Virgin Islands', 'Active'),
(55, 'VA', 'Virginia', 'Active'),
(56, 'WA', 'Washington', 'Active'),
(57, 'WV', 'West Virginia', 'Active'),
(58, 'WI', 'Wisconsin', 'Active'),
(59, 'WY', 'Wyoming', 'Active');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_users`
-- 

CREATE TABLE `tbl_users` (
  `id` bigint(30) NOT NULL auto_increment,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `send_email` tinyint(4) NOT NULL default '0',
  `email` varchar(100) NOT NULL,
  `grouplist` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` bigint(20) unsigned NOT NULL,
  `Address` varchar(255) NOT NULL,
  `LoggedIn` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL default 'Inactive',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- 
-- Dumping data for table `tbl_users`
-- 

INSERT INTO `tbl_users` (`id`, `firstname`, `lastname`, `username`, `password`, `send_email`, `email`, `grouplist`, `dob`, `city`, `state`, `zip`, `Address`, `LoggedIn`, `created_on`, `Status`) VALUES 
(1, 'Winifred', 'Ruby', 'Winifred', 'rubym', 0, 'winifredruby.r@gmail.com', '', '1982-01-01', 'chennai', 'AS', 12345, '', 1, '2008-01-04 10:41:05', 'Active'),
(5, 'James', 'Kennedy', 'test3', 'test', 0, 'afasdf@asdff.com', '1|', '1950-01-01', 'asdf', 'AR', 34234, '', 1, '2008-01-04 16:26:58', 'Active'),
(6, 'Anitha', 'Joci', 'anitha', 'anitha', 0, 'anitha@gmail.com', '1|2|', '1950-01-01', 'asdf', 'GU', 78945, '', 0, '2008-01-05 11:14:39', 'Active'),
(7, 'asdf', 'asdf', 'asdf', 'asdf', 0, 'asdf@asdf.com', '', '0000-00-00', 'asdf', 'CT', 0, 'asdf', 0, '2008-01-05 15:32:13', 'Inactive'),
(8, 'Leavea', 'Bharathy', 'leavea', 'leavea', 0, 'rubymary@securenext.net', '1|', '0000-00-00', 'asdf', 'AK', 0, 'asdfasdf', 0, '2008-01-05 15:34:20', 'Inactive'),
(9, 'Julie', 'Magi', 'julie', 'julie', 0, 'winifredruby.r@hotmail.com', '', '0000-00-00', 'asdf', 'FM', 0, 'asdf', 0, '2008-01-05 15:42:49', 'Active'),
(10, 'mancy', 'rai', 'mancy', 'mancy', 0, 'seetharaman@securenext.net', '', '0000-00-00', 'adf', 'AL', 0, 'asdf', 1, '2008-01-05 15:48:45', 'Active'),
(11, 'Reni', 'manick', 'reni', 'password', 0, 'rubymala@securenext.net', '2|11|', '1950-01-01', 'aasdf', 'GA', 98745, '', 0, '2008-01-08 14:40:30', 'Active'),
(12, 'sram', 'L', 'sram', '12345', 0, 'seetharam@securenext.net', '1|2|11|', '1954-08-04', 'Madurai', 'IL', 5897896757, '', 1, '2008-01-08 18:39:08', 'Active'),
(13, 'Lk', 'Malar', 'malar', 'password', 0, 'rubymaaa@securenext.net', '', '1950-01-01', 'asdfasdf', 'ID', 78945, '', 0, '2008-01-08 18:57:05', 'Active'),
(20, 'ahmed', 'shams', 'ashams', 'mohamahm', 0, 'rubym@securenext.net', '1|2|11|', '1950-01-01', 'asdf', 'GU', 213131, '', 1, '2008-01-08 19:16:12', 'Active'),
(21, 'Senthil', 'Kumar', 'senthil', 'senthil', 0, 'skumar@securenext.net', '2|', '1980-01-01', 'Chennai', '0', 600041, '', 1, '2008-01-10 08:52:14', 'Active');
