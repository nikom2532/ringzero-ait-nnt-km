/*
Navicat SQL Server Data Transfer

Source Server         : ENJ01
Source Server Version : 105000
Source Host           : localhost:1433
Source Database       : KM
Source Schema         : dbo

Target Server Type    : SQL Server
Target Server Version : 105000
File Encoding         : 65001

Date: 2014-05-20 16:04:25
*/


-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE [dbo].[account]
GO
CREATE TABLE [dbo].[account] (
[ACC_id] int NOT NULL IDENTITY(1,1) ,
[ACC_username] varchar(30) NULL ,
[ACC_password] varchar(30) NULL ,
[ACC_name] varchar(150) NULL ,
[ACC_dep1] varchar(255) NULL ,
[ACC_dep2] varchar(255) NULL ,
[ACC_position] varchar(255) NULL ,
[ACC_email] varchar(100) NULL ,
[ACC_type] varchar(255) NULL ,
[ACC_menu] ntext NULL ,
[ACC_activated] int NULL ,
[ACC_userupdate] varchar(150) NULL ,
[ACC_add] datetime NULL ,
[ACC_update] datetime NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[account]', RESEED, 4)
GO

-- ----------------------------
-- Records of account
-- ----------------------------
SET IDENTITY_INSERT [dbo].[account] ON
GO
INSERT INTO [dbo].[account] ([ACC_id], [ACC_username], [ACC_password], [ACC_name], [ACC_dep1], [ACC_dep2], [ACC_position], [ACC_email], [ACC_type], [ACC_menu], [ACC_activated], [ACC_userupdate], [ACC_add], [ACC_update]) VALUES (N'1', N'admin', N'123456', N'ธณัฐชัย แก้วมงคล', null, null, null, null, N'Administrator', N'ALL', N'1', N'ธณัฐชัย แก้วมงคล', N'2014-05-08 17:28:22.000', N'2014-05-08 17:28:26.000')
GO
GO
INSERT INTO [dbo].[account] ([ACC_id], [ACC_username], [ACC_password], [ACC_name], [ACC_dep1], [ACC_dep2], [ACC_position], [ACC_email], [ACC_type], [ACC_menu], [ACC_activated], [ACC_userupdate], [ACC_add], [ACC_update]) VALUES (N'3', N'admin2', N'123456', N'อลงกรณ์ รังสิกุล', N'AIT', N'AIT', N'Programmer', N'test@ait.co.th', null, N'ผู้เชี่ยวชาญ', N'1', N'อลงกรณ์ รังสิกุล', N'2014-05-09 00:16:34.000', N'2014-05-17 19:52:18.000')
GO
GO
INSERT INTO [dbo].[account] ([ACC_id], [ACC_username], [ACC_password], [ACC_name], [ACC_dep1], [ACC_dep2], [ACC_position], [ACC_email], [ACC_type], [ACC_menu], [ACC_activated], [ACC_userupdate], [ACC_add], [ACC_update]) VALUES (N'4', N'admin3', N'123456', N'testtest testtest', N'AIT', N'AIT', N'Programmer', N'test@ait.co.th', null, N'สมาชิก', N'1', N'ธณัฐชัย แก้วมงคล', N'2014-05-17 20:26:18.000', N'2014-05-17 20:26:18.000')
GO
GO
SET IDENTITY_INSERT [dbo].[account] OFF
GO

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE [dbo].[address]
GO
CREATE TABLE [dbo].[address] (
[ADD_id] int NOT NULL ,
[ADD_address] text NULL ,
[ADD_tel] varchar(255) NULL ,
[ADD_fax] varchar(255) NULL ,
[ADD_web] varchar(255) NULL ,
[ADD_email] varchar(255) NULL ,
[ADD_update] datetime2(7) NULL ,
[ADD_userupdate] varchar(150) NULL ,
[ADD_image] varchar(255) NULL 
)


GO

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO [dbo].[address] ([ADD_id], [ADD_address], [ADD_tel], [ADD_fax], [ADD_web], [ADD_email], [ADD_update], [ADD_userupdate], [ADD_image]) VALUES (N'1', N'เลขที่9 ซอยอารีย์สัมพันธ์ ถนนพระราม6 แขวงสามเสนใน เขตพญาไท กรุงเทพ 10400', N'02-618-2323', N'02-618-2364, 02-618-2399', N'http://www.prd.go.th', N'webmaster@prd.go.th', N'2014-05-20 16:28:29.0000000', N'ธณัฐชัย แก้วมงคล', N'abb3f3d7bd6c63fcfb6823bd46b454a6.png')
GO
GO

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE [dbo].[article]
GO
CREATE TABLE [dbo].[article] (
[ATC_id] int NOT NULL IDENTITY(1,1) ,
[ATC_category_ref] int NULL ,
[ATC_writer_key] int NULL ,
[ATC_image] varchar(150) NULL ,
[ATC_date] date NULL ,
[ATC_title] varchar(255) NULL ,
[ATC_short_desc] text NULL ,
[ATC_desc] ntext NULL ,
[ATC_tag] text NULL ,
[ATC_writer] varchar(150) NULL ,
[ATC_video] varchar(50) NULL ,
[ATC_file] varchar(50) NULL ,
[ATC_status] varchar(30) NOT NULL ,
[ATC_approve_by] varchar(150) NULL ,
[ATC_add] datetime NULL ,
[ATC_update] datetime NULL ,
[ATC_viewall] int NULL ,
[ATC_quality] int NULL ,
[ATC_activated] int NULL ,
[ATC_comment] text NULL ,
[ATC_userupdate] varchar(150) NULL ,
[ATC_suggest] int NULL DEFAULT ((0)) ,
[ATC_reason] text NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[article]', RESEED, 2)
GO

-- ----------------------------
-- Records of article
-- ----------------------------
SET IDENTITY_INSERT [dbo].[article] ON
GO
INSERT INTO [dbo].[article] ([ATC_id], [ATC_category_ref], [ATC_writer_key], [ATC_image], [ATC_date], [ATC_title], [ATC_short_desc], [ATC_desc], [ATC_tag], [ATC_writer], [ATC_video], [ATC_file], [ATC_status], [ATC_approve_by], [ATC_add], [ATC_update], [ATC_viewall], [ATC_quality], [ATC_activated], [ATC_comment], [ATC_userupdate], [ATC_suggest], [ATC_reason]) VALUES (N'1', N'4', N'1', N'a0f506c8e230e80f58e344f63a5be254.png', N'2014-05-12', N'ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน', N'ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน 
ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน  ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน', N'&lt;p&gt;
	ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน&lt;/p&gt;
&lt;p&gt;
	&amp;nbsp;&lt;/p&gt;
&lt;p&gt;
	ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชนระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชนระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชนระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน&lt;/p&gt;
&lt;p&gt;
	&amp;nbsp;&lt;/p&gt;
&lt;p&gt;
	ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชนระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชนระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชนระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชนระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชนระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชนระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน&lt;/p&gt;', N'พระราชสำนัก,วาเลนไทน,ตำรวจ,เคอร์ฟิว,ออกจากบ้าน,อันตราย,บ้าน,เยาวชน 18 ปี', N'อลงกรณ์ รังสิกุล', N'd021b7dea32c42e9b2a9439e6fdf1dd3.FLV', N'367f024043092192e5dccc13158509ab.pdf', N'1อนุญาตให้เผยแพร่', N'ธณัฐชัย แก้วมงคล', N'2014-05-12 17:58:19.000', N'2014-05-19 14:09:13.000', N'150', N'5', N'1', N'ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ  fff', N'ธณัฐชัย แก้วมงคล', N'1', null)
GO
GO
INSERT INTO [dbo].[article] ([ATC_id], [ATC_category_ref], [ATC_writer_key], [ATC_image], [ATC_date], [ATC_title], [ATC_short_desc], [ATC_desc], [ATC_tag], [ATC_writer], [ATC_video], [ATC_file], [ATC_status], [ATC_approve_by], [ATC_add], [ATC_update], [ATC_viewall], [ATC_quality], [ATC_activated], [ATC_comment], [ATC_userupdate], [ATC_suggest], [ATC_reason]) VALUES (N'2', N'5', N'3', N'5551d955fa743b62e2ee2cb24408c32d.jpg', N'2014-05-15', N'ทดสอบ', N'ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ', N'&lt;p&gt;
	ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;&lt;/p&gt;
&lt;p&gt;
	ทดสอบ ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;&lt;/p&gt;
&lt;p&gt;
	ทดสอบ ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;&lt;/p&gt;
&lt;p&gt;
	ทดสอบ ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;&lt;/p&gt;
&lt;p&gt;
	ทดสอบ ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;&lt;/p&gt;
&lt;p&gt;
	ทดสอบ ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;&lt;/p&gt;
&lt;p&gt;
	ทดสอบ ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;&lt;/p&gt;
&lt;p&gt;
	ทดสอบ ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;&lt;/p&gt;
&lt;p&gt;
	ทดสอบ ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;ทดสอบ&amp;nbsp;&lt;/p&gt;', N'ทดสอบ', null, null, null, N'2ไม่ผ่านการตรวจสอบ', N'ธณัฐชัย แก้วมงคล', N'2014-05-15 22:45:40.000', N'2014-05-20 16:00:43.000', N'12', N'5', N'1', N'ดี', N'ธณัฐชัย แก้วมงคล', N'0', N'FFFFFFFFFFFFFFF')
GO
GO
SET IDENTITY_INSERT [dbo].[article] OFF
GO

-- ----------------------------
-- Table structure for article_gallery
-- ----------------------------
DROP TABLE [dbo].[article_gallery]
GO
CREATE TABLE [dbo].[article_gallery] (
[AG_id] int NOT NULL IDENTITY(1,1) ,
[AG_article_ref] int NULL ,
[AG_image] varchar(150) NULL ,
[AG_add] datetime2(7) NULL ,
[AG_userupdate] varchar(150) NULL 
)


GO

-- ----------------------------
-- Records of article_gallery
-- ----------------------------
SET IDENTITY_INSERT [dbo].[article_gallery] ON
GO
SET IDENTITY_INSERT [dbo].[article_gallery] OFF
GO

-- ----------------------------
-- Table structure for article_monthly
-- ----------------------------
DROP TABLE [dbo].[article_monthly]
GO
CREATE TABLE [dbo].[article_monthly] (
[AM_id] int NOT NULL IDENTITY(1,1) ,
[AM_atc_ref] int NULL ,
[AM_year] varchar(4) NULL ,
[AM_month] varchar(2) NULL ,
[AM_view] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[article_monthly]', RESEED, 2)
GO

-- ----------------------------
-- Records of article_monthly
-- ----------------------------
SET IDENTITY_INSERT [dbo].[article_monthly] ON
GO
INSERT INTO [dbo].[article_monthly] ([AM_id], [AM_atc_ref], [AM_year], [AM_month], [AM_view]) VALUES (N'1', N'1', N'2014', N'05', N'150')
GO
GO
INSERT INTO [dbo].[article_monthly] ([AM_id], [AM_atc_ref], [AM_year], [AM_month], [AM_view]) VALUES (N'2', N'2', N'2014', N'05', N'12')
GO
GO
SET IDENTITY_INSERT [dbo].[article_monthly] OFF
GO

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE [dbo].[category]
GO
CREATE TABLE [dbo].[category] (
[CAT_id] int NOT NULL IDENTITY(1,1) ,
[CAT_topic] varchar(255) NULL ,
[CAT_activated] int NULL ,
[CAT_add] datetime NULL ,
[CAT_update] datetime NULL ,
[CAT_userupdate] varchar(150) NULL ,
[CAT_order] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[category]', RESEED, 6)
GO

-- ----------------------------
-- Records of category
-- ----------------------------
SET IDENTITY_INSERT [dbo].[category] ON
GO
INSERT INTO [dbo].[category] ([CAT_id], [CAT_topic], [CAT_activated], [CAT_add], [CAT_update], [CAT_userupdate], [CAT_order]) VALUES (N'1', N'พระราชสำนัก', N'1', N'2014-05-08 23:23:23.000', N'2014-05-09 00:10:39.000', N'ธณัฐชัย แก้วมงคล', N'3')
GO
GO
INSERT INTO [dbo].[category] ([CAT_id], [CAT_topic], [CAT_activated], [CAT_add], [CAT_update], [CAT_userupdate], [CAT_order]) VALUES (N'2', N'การเมือง/ความมั่นคง', N'1', N'2014-05-08 23:24:02.000', N'2014-05-09 00:11:12.000', N'ธณัฐชัย แก้วมงคล', N'1')
GO
GO
INSERT INTO [dbo].[category] ([CAT_id], [CAT_topic], [CAT_activated], [CAT_add], [CAT_update], [CAT_userupdate], [CAT_order]) VALUES (N'3', N'เศรษฐกิจ/ท่องเที่ยว', N'1', N'2014-05-09 00:11:18.000', N'2014-05-09 00:11:18.000', N'ธณัฐชัย แก้วมงคล', N'5')
GO
GO
INSERT INTO [dbo].[category] ([CAT_id], [CAT_topic], [CAT_activated], [CAT_add], [CAT_update], [CAT_userupdate], [CAT_order]) VALUES (N'4', N'สังคม', N'1', N'2014-05-09 00:11:27.000', N'2014-05-09 00:11:27.000', N'ธณัฐชัย แก้วมงคล', N'6')
GO
GO
INSERT INTO [dbo].[category] ([CAT_id], [CAT_topic], [CAT_activated], [CAT_add], [CAT_update], [CAT_userupdate], [CAT_order]) VALUES (N'5', N'ต่างประเทศ', N'1', N'2014-05-09 00:11:36.000', N'2014-05-09 00:11:36.000', N'ธณัฐชัย แก้วมงคล', N'2')
GO
GO
INSERT INTO [dbo].[category] ([CAT_id], [CAT_topic], [CAT_activated], [CAT_add], [CAT_update], [CAT_userupdate], [CAT_order]) VALUES (N'6', N'วิทยาศาสตร์', N'1', N'2014-05-09 00:11:45.000', N'2014-05-09 00:11:45.000', N'ธณัฐชัย แก้วมงคล', N'4')
GO
GO
SET IDENTITY_INSERT [dbo].[category] OFF
GO

-- ----------------------------
-- Table structure for contact_us
-- ----------------------------
DROP TABLE [dbo].[contact_us]
GO
CREATE TABLE [dbo].[contact_us] (
[CONT_id] int NOT NULL IDENTITY(1,1) ,
[CONT_name] varchar(255) NULL ,
[CONT_email] varchar(255) NULL ,
[CONT_tel] varchar(255) NULL ,
[CONT_message] text NULL ,
[CONT_add] datetime NULL ,
[CONT_useradd] varchar(255) NULL 
)


GO

-- ----------------------------
-- Records of contact_us
-- ----------------------------
SET IDENTITY_INSERT [dbo].[contact_us] ON
GO
INSERT INTO [dbo].[contact_us] ([CONT_id], [CONT_name], [CONT_email], [CONT_tel], [CONT_message], [CONT_add], [CONT_useradd]) VALUES (N'1', N'ธณัฐชัย แก้วมงคล', N'k.thanutchai@gmail.com', N'089-912-1234', N'ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ', N'2014-05-09 00:50:21.000', null)
GO
GO
SET IDENTITY_INSERT [dbo].[contact_us] OFF
GO

-- ----------------------------
-- Table structure for faq
-- ----------------------------
DROP TABLE [dbo].[faq]
GO
CREATE TABLE [dbo].[faq] (
[FAQ_id] int NOT NULL IDENTITY(1,1) ,
[FAQ_question] text NULL ,
[FAQ_answer] text NULL ,
[FAQ_activated] int NULL ,
[FAQ_add] datetime NULL ,
[FAQ_update] datetime NULL ,
[FAQ_userupdate] varchar(150) NULL ,
[FAQ_order] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[faq]', RESEED, 3)
GO

-- ----------------------------
-- Records of faq
-- ----------------------------
SET IDENTITY_INSERT [dbo].[faq] ON
GO
INSERT INTO [dbo].[faq] ([FAQ_id], [FAQ_question], [FAQ_answer], [FAQ_activated], [FAQ_add], [FAQ_update], [FAQ_userupdate], [FAQ_order]) VALUES (N'1', N'จะสมัครสมาชิกได้อย่างไร', N'ระบบไม่ได้อนุญาตให้สมัครสมาชิกได้เอง จะต้องเป็นเจ้าหน้าที่หรือพนักงานในหน่วยงาน สคบ.เท่านั้นที่มีสิทธิ์ใช้งานระบบ', N'1', N'2014-05-08 23:54:23.000', N'2014-05-09 00:06:41.000', N'ธณัฐชัย แก้วมงคล', N'1')
GO
GO
INSERT INTO [dbo].[faq] ([FAQ_id], [FAQ_question], [FAQ_answer], [FAQ_activated], [FAQ_add], [FAQ_update], [FAQ_userupdate], [FAQ_order]) VALUES (N'2', N'รายการถ่ายทอดสด จะรับชมได้ตอนไหน', N'ระบบไม่ได้อนุญาตให้สมัครสมาชิกได้เอง จะต้องเป็นเจ้าหน้าที่หรือพนักงานในหน่วยงาน สคบ.เท่านั้นที่มีสิทธิ์ใช้งานระบบ', N'1', N'2014-05-08 23:56:42.000', N'2014-05-08 23:56:42.000', N'ธณัฐชัย แก้วมงคล', N'2')
GO
GO
INSERT INTO [dbo].[faq] ([FAQ_id], [FAQ_question], [FAQ_answer], [FAQ_activated], [FAQ_add], [FAQ_update], [FAQ_userupdate], [FAQ_order]) VALUES (N'3', N'เจ้าหน้าที่สามารถสร้างเนื้อหาต่างๆได้เองหรือไม่', N'ระบบไม่ได้อนุญาตให้สมัครสมาชิกได้เอง จะต้องเป็นเจ้าหน้าที่หรือพนักงานในหน่วยงาน สคบ.เท่านั้นที่มีสิทธิ์ใช้งานระบบ', N'1', N'2014-05-08 23:57:09.000', N'2014-05-08 23:57:09.000', N'ธณัฐชัย แก้วมงคล', N'3')
GO
GO
SET IDENTITY_INSERT [dbo].[faq] OFF
GO

-- ----------------------------
-- Table structure for set_email
-- ----------------------------
DROP TABLE [dbo].[set_email]
GO
CREATE TABLE [dbo].[set_email] (
[SET_id] int NOT NULL IDENTITY(1,1) ,
[SET_email] text NULL 
)


GO

-- ----------------------------
-- Records of set_email
-- ----------------------------
SET IDENTITY_INSERT [dbo].[set_email] ON
GO
INSERT INTO [dbo].[set_email] ([SET_id], [SET_email]) VALUES (N'1', N'k.thanutchai@gmail.com, k.thanutchai@gmail.com')
GO
GO
SET IDENTITY_INSERT [dbo].[set_email] OFF
GO

-- ----------------------------
-- Indexes structure for table account
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table account
-- ----------------------------
ALTER TABLE [dbo].[account] ADD PRIMARY KEY ([ACC_id])
GO

-- ----------------------------
-- Indexes structure for table address
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table address
-- ----------------------------
ALTER TABLE [dbo].[address] ADD PRIMARY KEY ([ADD_id])
GO

-- ----------------------------
-- Indexes structure for table article
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table article
-- ----------------------------
ALTER TABLE [dbo].[article] ADD PRIMARY KEY ([ATC_id])
GO

-- ----------------------------
-- Indexes structure for table article_gallery
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table article_gallery
-- ----------------------------
ALTER TABLE [dbo].[article_gallery] ADD PRIMARY KEY ([AG_id])
GO

-- ----------------------------
-- Indexes structure for table article_monthly
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table article_monthly
-- ----------------------------
ALTER TABLE [dbo].[article_monthly] ADD PRIMARY KEY ([AM_id])
GO

-- ----------------------------
-- Indexes structure for table category
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table category
-- ----------------------------
ALTER TABLE [dbo].[category] ADD PRIMARY KEY ([CAT_id])
GO

-- ----------------------------
-- Indexes structure for table contact_us
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table contact_us
-- ----------------------------
ALTER TABLE [dbo].[contact_us] ADD PRIMARY KEY ([CONT_id])
GO

-- ----------------------------
-- Indexes structure for table faq
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table faq
-- ----------------------------
ALTER TABLE [dbo].[faq] ADD PRIMARY KEY ([FAQ_id])
GO

-- ----------------------------
-- Indexes structure for table set_email
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table set_email
-- ----------------------------
ALTER TABLE [dbo].[set_email] ADD PRIMARY KEY ([SET_id])
GO
