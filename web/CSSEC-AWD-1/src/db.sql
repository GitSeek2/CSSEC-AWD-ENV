-- MySQL dump 10.13  Distrib 5.7.26, for Win64 (x86_64)
--
-- Host: localhost    Database: csseccms001
-- ------------------------------------------------------
-- Server version	5.7.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--
DROP Database `csseccms001` if EXISTS;
CREATE DATABASE `csseccms001` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `csseccms001`;

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author_id` int(6) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (3,'AWD | AWD 入门 Part1 基础','在学习 AWD 之前，你需要了解并学习 SSH，SFTP，Linux，计算机网络，Python 等基础知识（其实都是计科基本功）。什么都不会？莫得问题，都是工具，多多使用、练习、思考、总结 就会了。<br />&nbsp;\nAWD 更多时候是一种比拼 一些基础知识的掌握程度以及比赛技巧 的比赛。同 CTF 一样，学习 AWD 对网工专业的许多知识都能起到 触类旁通 的作用。<br />&nbsp;\n本文内含有许多文档链接，建议大家都点进去看个眼熟，也希望大家能养成不了解的东西多多查文档的习惯。另外就是个人认为技术文档的获取方式没有绝对好的，也没有绝对坏的。我们没有必要因为一些 歧视/偏见 而错过更多的知识获取方式。<br />&nbsp;\n任何问题欢迎在本文评论区、信安群提出。<br />&nbsp;\n...','2024-06-02 09:46:00','2024-06-02 09:46:00',1),(4,'AWD | AWD 入门 Part2 实操','文中涉及的操作仅仅是一场 AWD 所需要最基本的操作（LNMP/LAMP 环境的简单操作），想要达到能够正常参加一场线下 AWD 比赛的水平，需要掌握更多的技能和花活。<br />&nbsp;\n遇见任何有疑惑的地方，记得查资料，不要放过它。<br />&nbsp;\n...','2024-06-02 09:46:30','2024-06-02 09:46:30',1),(6,'AWD | AWD比赛指导手册','手册版本号：V1.2.2-2023/10/21<br />&nbsp;\n<br />&nbsp;\n这是一本能让你从零开始学习AWD并深入AWD的手册，我也会根据经验和需求逐步完善相关内容。如果你要参加AWD相关比赛，相信本项目能给你带来帮助~<br />&nbsp;\n<br />&nbsp;\n如何在线阅读？<br />&nbsp;\n<br />&nbsp;\n● 个人博客地址： https://blog.zgsec.cn/archives/484.html<br />&nbsp;\n● 微信公众号地址：https://mp.weixin.qq.com/s/1vR1rcGHK6YYdXlp4McR_w<br />&nbsp;\n<br />&nbsp;\n如果你觉得本项目不错，欢迎给我点个Star，万分感谢~~ 有什么新的攻击或者防守的姿势、手法，欢迎与我交流<br />&nbsp;\n<br />&nbsp;\n0# 什么是AWD<br />&nbsp;\n<br />&nbsp;\n0.1# AWD赛制介绍<br />&nbsp;\n<br />&nbsp;\n「 攻防模式 | AWD (Attack With Defense) 」 是 CTF比赛 「CTF Capture The Flag」 几种主要的比赛模式之一，该模式常见于线下赛。<br />&nbsp;\n<br />&nbsp;\n在该模式中，每个队伍都拥有一个相同的初始环境 ( 我们称其为 GameBox )，该环境通常运行着一些特定的服务或应用程序，而这些服务通常包含一些安全漏洞。参赛队伍需要挖掘利用对方队伍服务中的安全漏洞，获取 Flag 以获得积分; 同时，参赛队伍也需要修补自身服务漏洞进行防御，以防被其他队伍攻击和获取 Flag。<br />&nbsp;\n<br />&nbsp;\n主要特点为：强调实战性、实时性、对抗性，综合考量竞赛队的渗透能力和防护能力。<br />&nbsp;\n<br />&nbsp;\n0.2# 比赛整体流程<br />&nbsp;\n<br />&nbsp;\n● 赛前准备环节：我们会分配到多个靶机服务器，通常是分配给我们 SSH 或者 VNC 的用户名和密码，还有相关IP等信息<br />&nbsp;\n● 安全加固环节：我们需要先自己去登录靶机服务器，进行30分钟的安全加固（源码备份/弱口令修改/代码审计和修复/漏洞修复等）<br />&nbsp;\n● 自由攻击环节：安全加固时间过后，开始自由攻击环节，通过对别的队伍的靶机服务器进行攻击（弱口令/Web漏洞/系统漏洞等）获得Flag进行加分，对应队伍失分<br />&nbsp;\n<br />&nbsp;\n1# 比赛环境<br />&nbsp;\n<br />&nbsp;\n通常比赛环境有以下三种情况：<br />&nbsp;\n<br />&nbsp;\n● 混合靶机情况：运维机器 Windows 10 + 攻击机 Kali Linux + Win靶机 Windows Server 2003/2008/2012 或者 Windows 7 + Linux靶机 Centos7.x 或者 Ubuntu 16.04/17.01/20.04<br />&nbsp;\n● 纯Linux靶机情况：运维机器 Windows 10 + 攻击机 Kali Linux + Linux靶机 Centos7.x 或者 Ubuntu 16.04/17.01/20.04<br />&nbsp;\n● 纯Windows靶机情况：运维机器 Windows 10 + 攻击机 Kali Linux + Win靶机 Windows Server 2003/2008/2012 或者 Windows 7<br />&nbsp;\n<br />&nbsp;\n可能有师傅这里看不太懂，那我可以用大白话描述一下：比赛的时候，会给你1~2台运维机器（一般是Win10里面装了Kali）以及好几台服务器（也就是上面说的靶机），服务器上面有漏洞，要先抓紧去找到漏洞并修复（可别忘了弱口令哦），再通过找到的漏洞去攻击别的队伍的服务器拿到Flag从而得分<br />&nbsp;\n...','2024-06-02 09:48:23','2024-06-02 09:48:23',1),(2,'提问的智慧','在黑客的世界里，你所提技术问题的解答的好坏, 很大程度上取决于你提问的方式与此问题的难度。本指南将教你如何正确地提问以获得你满意的答案。<br />&nbsp;\n<br />&nbsp;\n现在开源（Open Source）软件已经相当盛行，您通常可以从其他更有经验的用户那里获得与黑客一样好的答案，这是件好事；和黑客相比，用户们往往对那些新手常遇到的问题更宽容一些。尽管如此，以我们在此推荐的方式对待这些有经验的用户通常也是从他们那里获得有用答案的最有效方式。<br />&nbsp;\n<br />&nbsp;\n首先你应该明白，黑客们喜爱有挑战性的问题，或者能激发他们思维的好问题。如果我们并非如此，那我们也不会成为你想询问的对象。如果你给了我们一个值得反复咀嚼玩味的好问题，我们自会对你感激不尽。好问题是激励，是厚礼。好问题可以提高我们的理解力，而且通常会暴露我们以前从没意识到或者思考过的问题。对黑客而言，“好问题！”是诚挚的大力称赞。<br />&nbsp;\n<br />&nbsp;\n尽管如此，黑客们有着蔑视或傲慢面对简单问题的坏名声，这有时让我们看起来对新手、无知者似乎较有敌意，但其实不是那样的。<br />&nbsp;\n<br />&nbsp;\n我们不讳言我们对那些不愿思考、或者在发问前不做他们该做的事的人的蔑视。那些人是时间杀手 —— 他们只想索取，从不付出，消耗我们可用在更有趣的问题或更值得回答的人身上的时间。我们称这样的人为 失败者（loser） （由于历史原因，我们有时把它拼作 lusers）。<br />&nbsp;\n<br />&nbsp;\n我们意识到许多人只是想使用我们写的软件，他们对学习技术细节没有兴趣。对大多数人而言，电脑只是种工具，是种达到目的的手段而已。他们有自己的生活并且有更要紧的事要做。我们认可这点，也从不指望每个人都对这些让我们着迷的技术问题感兴趣。尽管如此，我们只为那些真正有兴趣并愿意积极参与问题解决的人调整回答问题的风格。这点不会变，也不该变：否则，我们就是在最擅长的事情上降低效率。<br />&nbsp;\n<br />&nbsp;\n我们（在很大程度上）是自愿的，从繁忙的生活中抽出时间来解答疑惑，而且时常被提问淹没。所以我们无情地滤掉一些话题，特别是拋弃那些看起来像失败者的家伙，以便更高效地利用时间来回答赢家（winner）的问题。<br />&nbsp;\n<br />&nbsp;\n如果你厌恶我们的态度，高高在上，或过于傲慢，不妨也设身处地想想。我们并没有要求你向我们屈服 —— 事实上，我们大多数人非常乐意与你平等地交流，只要你付出小小努力来满足基本要求，我们就会欢迎你加入我们的文化。但让我们帮助那些不愿意帮助自己的人是没有效率的。无知没有关系，但装白痴就是不行。<br />&nbsp;\n<br />&nbsp;\n所以，你不必在技术上很在行才能吸引我们的注意，但你必须表现出能引导你变得在行的特质 —— 机敏、有想法、善于观察、乐于主动参与解决问题。如果你做不到这些使你与众不同的事情，我们建议你花点钱找家商业公司签个技术支持服务合同，而不是要求黑客个人无偿地帮助你。<br />&nbsp;\n<br />&nbsp;\n如果你决定向我们求助，当然你也不希望被视为失败者，更不愿成为失败者中的一员。能立刻得到快速并有效答案的最好方法，就是像赢家那样提问 —— 聪明、自信、有解决问题的思路，只是偶尔在特定的问题上需要获得一点帮助。<br />&nbsp;\n<br />&nbsp;\n（欢迎对本指南提出改进意见。你可以把你的建议发送至 esr@thyrsus.com 或 respond-auto@linuxmafia.com。然而请注意，本文并非网络礼节的通用指南，而我们通常会拒绝无助于在技术论坛得到有用答案的建议）。','2024-06-02 09:44:14','2024-06-02 09:44:14',1),(7,'Misc_Introduction for NewCTFER','前言<br />&nbsp;\nMISC，意思就是杂项，杂是他的一大特点，很多人的固有印象是这个方向全是工具，其实不然，MISC是一个很讲究原理的方向，如果你抛弃原理，全拿工具一把梭，那么你肯定在MISC的世界是走不远的。<br />&nbsp;\n为什么会有工具这个东西，因为学MISC的人很多，而且大多都是很强的人，所以开发出来的方便大家用的工具也会很多，但是不能依赖工具。<br />&nbsp;\nMISC也是一门很考验自学能力的方向，在一些线上比赛中，很可能会遇到过见都没见过的东西，这个时候就需要自己去找，如果没有一定的信息检索能力和自主独立能力，那我建议还是别学CTF。<br />&nbsp;\n需要工具的时候，先自己尝试去找，不建议当伸手怪，只是找的时候，注意不要下到捆绑软件了，实在找不到了，可以来找我要QQ:2729913542，因为这样可以锻炼信息检索能力。<br />&nbsp;\n<br />&nbsp;\n主体<br />&nbsp;\n至于MISC怎么学，我觉得了解一点编码和文件结构就可以开始刷题了，因为MISC没有在线靶场，我在这里推荐BUUCTF https://buuoj.cn/ 或者是攻防世界 https://adworld.xctf.org.cn/ 去刷题，刷题的目的不是为了刷题，通过题目去学习这个隐写的原理或者是判断方法，不要为了数量刷题，这样子学起来会很慢。<br />&nbsp;\nMISC其实大致可以分成五种，流量分析，取证，隐写，创新，社工。<br />&nbsp;\n但是但是，学MISC前，应该先学习学习一些比较基础的编码，比如base64，二进制十六进制什么的。推荐一篇博客 https://blog.csdn.net/Ahuuua/article/details/109189985<br />&nbsp;\n<br />&nbsp;\n流量分析<br />&nbsp;\n这个东西简单来说就是将访问网址或者是机器的每个协议的每个请求包都拦截下来，解析成人类可以理解的形式。然后题目就是给你一个流量包，你需要通过这个流量包分析出出题人做了什么，以及flag被藏在了哪里。<br />&nbsp;\n这个需要的前置知识较多，不建议初学者从这里开学。但是也比较简单，如果有感兴趣的可以来找我私聊私聊。<br />&nbsp;\n<br />&nbsp;\n取证<br />&nbsp;\n简单来说，就是通过出题人给你的计算机内存文件或者是系统镜像，你需要通过一系列的操作来获取到flag，一般用的是volatility来分析内存，具体可以从这篇博客了解 https://www.cnblogs.com/zysgmzb/p/15905869.html<br />&nbsp;\n这东西需要的基础前置知识较多，如果感兴趣的可以找我私聊，我可以线下给你介绍介绍。<br />&nbsp;\n<br />&nbsp;\n隐写<br />&nbsp;\n建议初学者从这里开始学。 https://buuoj.cn/challenges，可以在这里面体验几道题，前几道题都是隐写的<br />&nbsp;\n这个方向分的就很细了，就拉到一起讲了<br />&nbsp;\n隐写隐写，就是隐藏着写，就是将一段文字隐藏到一张图，一段音频，你需要借助一定的工具和手动，来获取到被隐藏的那段文字，这就是隐写。隐写方式有很多种，不能一蹴而就的，需要自己去了解，如果不会的题目，先搜搜 writeup，再尝试复现这道题目，不要直接交flag，这样达不到学习的效果，而且最好是做好记录，毕竟MISC也是一个考验积累的方向。<br />&nbsp;\n<br />&nbsp;\n创新<br />&nbsp;\n这类题一般涉及一些奇奇怪怪的知识点，这时候考验的就是自学能力，你需要随机应变，学习一下涉及到的东西的原理，再去解题。<br />&nbsp;\n<br />&nbsp;\n社工<br />&nbsp;\n社会工程学，简单来说，就是给你一个图片或者是其他什么，你要获得他的一些信息，就是低级版的开盒。<br />&nbsp;\n<br />&nbsp;\n文末<br />&nbsp;\n学长文笔不太好，总结的不太好，多多担待，<br />&nbsp;\n说实话，MISC并不是一个好找工作的方向，但是MISC是一个很好玩的方向，学弟学妹们酌情选择。<br />&nbsp;\n最后，建议学弟学妹们去了解了解提问的智慧，在各个地方都能有益的一个东西❤<br />&nbsp;\n<br />&nbsp;\nBy y1shin','2024-06-02 09:50:31','2024-06-02 09:50:31',1),(8,'安全领域特殊名词解释','CTF<br />&nbsp;\nCTF（Capture The Flag）中文一般译作夺旗赛，在网络安全领域中指的是网络安全技术人员之间进行技术竞技的一种比赛形式。CTF 起源于 1996 年 DEFCON 全球黑客大会，以代替之前黑客们通过互相发起真实攻击进行技术比拼的方式。 百度百科<br />&nbsp;\nWeb<br />&nbsp;\n广义的 web 指 World Wide Web ，即全球广域网，也称为万维网。狭义指 web pages（网页）或 website（网站）。CTF 中指 Web 安全，涉及到与 Web 应用相关的各种安全问题。<br />&nbsp;\nPwn<br />&nbsp;\n源自骇客俚语，在 CTF 中通常指的是通过二进制漏洞攻击和利用来控制系统或获取权限。 维基百科&nbsp;&nbsp; CTF Wiki<br />&nbsp;\nMisc<br />&nbsp;\n杂项，CTF 中的一种题目类型，包括但不限于信息搜集、编码分析、取证分析、隐写分析等。 CTF Wiki<br />&nbsp;\nCrypto<br />&nbsp;\n密码学，CTF 中一般为现代密码学的安全问题。<br />&nbsp;\nReverse Engineering<br />&nbsp;\n逆向工程，通过分析软件的二进制代码来理解其工作原理，获取敏感数据。<br />&nbsp;\nBlockchain<br />&nbsp;\n区块链，起源于比特币（Bitcoin），一种分布式数据库技术，常用于加密货币等。<br />&nbsp;\nIoT<br />&nbsp;\n物联网（英语：Internet of Things，简称IoT），IoT是将物品用网络连接起来，实现物与物、物与人的泛在连接，实现对物品和过程的智能化感知、识别和管理。IoT 安全 是指通过保护、识别和监测风险，确保互联网设备及其所连接的网络免受威胁和破坏，同时帮助修复来自一系列设备的漏洞，这些漏洞可能对您的业务构成安全风险。https://security.tencent.com/index.php/blog/msg/171<br />&nbsp;\n计算机取证<br />&nbsp;\n计算机取证也称为数字取证、计算机取证科学或网络取证，它将计算机科学和法律取证相结合，收集法庭可采纳的数字证据。IBM<br />&nbsp;\nOSINT<br />&nbsp;\n开源网络情报（Open source intelligence ），简称OSINT，是美国中央情报局（CIA）的一种情报搜集手段，从各种公开的信息资源中寻找和获取有价值的情报。CTF 中常表现为网络迷踪游戏。https://sspai.com/post/73193<br />&nbsp;\nAWD<br />&nbsp;\nAttack With Defense，即攻防模式，CTF比赛的一种特殊模式，队伍需要同时进行攻击和防御。<br />&nbsp;\nAWDP<br />&nbsp;\nAttack With Defense Plus，即攻防加强模式，是一种更复杂的 CTF 比赛模式。<br />&nbsp;\nPOC<br />&nbsp;\nProof Of Concept，概念验证，通常是指验证某个漏洞或攻击技术的有效性的代码或工具。<br />&nbsp;\nEXP<br />&nbsp;\nExploit，漏洞利用，通常是指利用某个漏洞进行攻击的代码或工具。<br />&nbsp;\nPayload<br />&nbsp;\n有效载荷，指的是攻击者通过漏洞传送到目标系统执行的代码。<br />&nbsp;\nShellcode<br />&nbsp;\n一段用于控制被攻击系统的小程序代码。<br />&nbsp;\n后门<br />&nbsp;\n一种隐藏的入口，攻击者通过后门可以无需正常的认证过程就能访问系统。<br />&nbsp;\nShell<br />&nbsp;\nShell在计算机科学中指“为用户提供用户界面”的软件，通常指的是命令行界面的解析器。CTF 中一般指的是获取的远程系统的控制权限。 维基百科<br />&nbsp;\nWebShell<br />&nbsp;\n运行在 Web 服务器上的脚本，攻击者通过 WebShell 可以控制服务器。<br />&nbsp;\nRCE<br />&nbsp;\nRemote Code Execution，远程代码执行。<br />&nbsp;\n弱口令<br />&nbsp;\n指的是容易被猜测或破解的密码。<br />&nbsp;\n免杀<br />&nbsp;\n指的是使恶意软件或攻击代码能够避免被安全软件检测到。<br />&nbsp;\n漏洞<br />&nbsp;\n系统或软件中的安全缺陷，攻击者可以利用漏洞进行攻击。<br />&nbsp;\n一血<br />&nbsp;\n在 CTF 等比赛中，某题目的第一个解为该题的“一血”。<br />&nbsp;\nAK<br />&nbsp;\n在 CTF 等比赛中，AK通常指的是 All Kill，即解出所有题目。<br />&nbsp;\npy交易<br />&nbsp;\nPy交易，网络流行词，原本指朋友交易。现一般意思是屁眼交易，指背后有见不得人的勾当。 百度百科<br />&nbsp;\n护网行动<br />&nbsp;\n是一项由公安部牵头的，以检测企事业单位的网络安全防护能力为目的，针对全国范围的真实网络目标为对象的网络安全攻防演练活动。有时大家也会称之为红蓝对抗，HW，HVV。<br />&nbsp;\n应急响应<br />&nbsp;\n在网络安全领域指对发生的网络安全事件进行应急处置。<br />&nbsp;\n重保<br />&nbsp;\n重要时期安全保障服务。在一些国家重要活动时期（重要会议，运动会，大型活动等）的安全保障服务。<br />&nbsp;\nOWASP Top Ten<br />&nbsp;\n由 OWASP 发行的“十大安全漏洞列表”文档，旨在通过识别组织面临的一些最重要的风险来提高对应用程序安全性的认识。开放式Web应用程序安全项目（OWASP）是一个在线社区，在Web应用安全领域提供免费的文章，方法，文档，工具和技术。 https://owasp.org/Top10/zh_CN/&nbsp;&nbsp; -维基百科','2024-06-02 09:51:55','2024-06-02 09:51:55',1),(9,'Web | 网站部署入门','PHP 网站的部署相对简单，因此本文以 PHP 网站部署为例，其他语言存在一些不同。<br />&nbsp;\n由于 PHP 在过去相当长一段时间里的广泛流行，其本身设计又具有较多安全问题，我们以后的 Web 安全学习会较多涉及，是新手入门 Web 安全较为推荐的知识点。<br />&nbsp;\n<br />&nbsp;\n<hr><br />&nbsp;\n<br />&nbsp;\n0x01 开始之前，你需要明白这些概念<br />&nbsp;\n<br />&nbsp;\n1. 网页、网站和网络服务器_MDN<br />&nbsp;\n<br />&nbsp;\n● 网页（webpage）：一份能够显示在网络浏览器（如 Firefox,，Google Chrome，Microsoft Internet Explorer 或 Edge，Apple 的 Safari）上的文档。网页也常被称作\"web pages\"（网页）或者就叫\"pages\"（页面）。<br />&nbsp;\n<br />&nbsp;\n● 网站（website）：一个由许多网页组合在一起，并常常以各种方式相互连接的网页组成的集合。网站常被称作\"web site\"（网站）或简称\"site\"（站点）。<br />&nbsp;\n<br />&nbsp;\n● 网络服务器（web server）：一个在互联网上托管网站的计算机。<br />&nbsp;\n<br />&nbsp;\n一般我们不用关注网站和网页的区别，但是仍然需要明白他们有一定区别。<br />&nbsp;\n要部署网站，首先要有一个网站的源码。方便起见，除非特殊说明，本文中的源码示例均只涉及一个网页。<br />&nbsp;\n<br />&nbsp;\n2. 一个网页一般由三种基本语言组成：<br />&nbsp;\n<br />&nbsp;\n● HTML（HyperText Markup Language，超文本标记语言）<br />&nbsp;\n● CSS（Cascading Style Sheets，层叠样式表）<br />&nbsp;\n● JavaScript<br />&nbsp;\n<br />&nbsp;\nHTML 和 CSS 并不是编程语言，HTML 是一种标准，CSS 更像是一种配置文件。一个网页如果没有 HTML，就不会有任何内容。没有 CSS 的网页将非常难看。而没有 JavaScript 的网页将缺少对用户友好的交互。<br />&nbsp;\n<br />&nbsp;\nHTML 定义了网页的内容，CSS 描述了网页的布局，JavaScript 控制了网页的行为。他们的具体细节，这里不展开叙述，你可以在 菜鸟教程 和 MDN 深入学习（JS 最为重要）。','2024-06-02 10:03:57','2024-06-02 10:03:57',1);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'CSSEC CMS','1717320629.jpg','CSSEC CMS 是一个简单的内容管理系统，基于 PHP 语言开发，使用 MySQL 数据库存储数据，用作信安组 AWD 练习的 Web 题目。','2024-06-02 09:30:29'),(2,'信息安全组 | CSSEC','1717320708.jpg','信息安全组，简称信安组，也称 CSSEC，是 四川师范大学IT培优 项目下编程组所属的一个学习小组。小组致力于在川师计科学院营造良好的网络安全 & CTF 学习氛围。','2024-06-02 09:31:48'),(3,'Seek2 Team','1717320920.png','一个专注于 CTF 赛事的团队，我们希望它能更加纯粹（请忽略这个草率的 logo）。','2024-06-02 09:35:20');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notices`
--

DROP TABLE IF EXISTS `notices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notices` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notices`
--

LOCK TABLES `notices` WRITE;
/*!40000 ALTER TABLE `notices` DISABLE KEYS */;
INSERT INTO `notices` VALUES (1,'CSSEC AWD 001 正在进行中！！！','由信安组（CSSEC）策划并承办的 CSSEC AWD 001 赛事已经端上来啦。本次比赛为 23 级 2 班与 3 班 CTF 创新与实践课程考核，希望来自两个班的近 100 名同学们攻防一体，赛出智慧、赛出风格、赛出友谊、赛出佳绩！','2024-06-02 09:28:44');
/*!40000 ALTER TABLE `notices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `power` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e',3,'2024-06-02 09:13:34');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-02 18:11:42
