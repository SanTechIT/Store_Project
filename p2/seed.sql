INSERT INTO Products
(Product_Name, Price, Image_Name, Rating, Product_Description)
VALUES
('Intel Core i7-8700K 6-Core 3.7 GHz'
,'349.99',
'assets/19-117-827-Z01.jpg',
'4.8',
'<ul class="browser-default">
<li>Only Compatible with Intel 300 Series Motherboard</li>
<li>For A Great VR Experience</li>
<li>Max Turbo Frequency 4.7 GHz</li>
<li>Intel UHD Graphics 630</li>
<li>Unlocked Processor</li>
<li>DDR4 Support</li>
<li>Socket LGA 1151 (300 Series)</li>
<li>Cooling device not included - Processor Only</li>
</ul>
'),
('AMD RYZEN 7 2700X 8-Core 3.7 GHz',
'329.99','assets/19-113-499-V01.jpg',
'4.8',
'<ul class="browser-default">
<li>2nd Gen Ryzen</li>
<li>AMD StoreMI Technology</li>
<li>AMD SenseMI Technology</li>
<li>AMD Ryzen Master Utility</li>
<li>Socket AM4</li>
<li>Max Boost Frequency 4.3 GHz</li>
<li>DDR4 Support</li>
<li>Unlocked Processor</li>
<li>Thermal Design Power 105W</li>
<li>AMD Wraith Prism Cooler Included</li>
</ul>'),
/*

*/
('Intel Core i5-8600K 6-Core 3.6 GHz',
'249.99',
'assets/19-117-825-Z01.jpg',
'5',
'<ul class="browser-default">
                
  <li class="item">
      Only Compatible with Intel 300 Series Motherboard
  </li>
  <li class="item">
      For A Great VR Experience
  </li>
  <li class="item">
      Max Turbo Frequency 4.3 GHz
  </li>
  <li class="item">
      Intel UHD Graphics 630
  </li>
  <li class="item">
      Unlocked Processor
  </li>
  <li class="item">
      DDR4 Support
  </li>
  <li class="item">
      Socket LGA 1151 (300 Series)
  </li>
  <li class="item">
      Cooling device not included - Processor Only
  </li>
</ul>'),
/*

*/
('AMD RYZEN 5 2400G Quad-Core 3.6 GHz','159.99','assets/19-113-480-V01.jpg','4.3',
'<ul class="browser-default">            
  <li class="item">
      Built-In Radeon Vega RX 11 Graphics
  </li>
  <li class="item">
      4 Cores / 8 Threads Unlocked
  </li>
  <li class="item">
      Frequency: 3.9 GHz Max Boost
  </li>
  <li class="item">
      Socket Type: AM4
  </li>
  <li class="item">
      6MB total cache
  </li>
  <li class="item">
      AMD Wraith Stealth Cooler Included
  </li>
  </ul>
'),
('MSI X470 GAMING PRO CARBON AM4 AMD X470','179.99','assets/13-144-178-V01.jpg','4.9',
'<ul class="browser-default">    
  <li class="item">
      AMD X470
  </li>
  <li class="item">
      Supports AMD RYZEN Desktop processors and A-series/ Athlon Processors for Socket AM4
  </li>
  <li class="item">
      Supports 2667/ 2400/ 2133/ 1866 MHz (by JEDEC)*
  </li>
  <li class="item">
      Supports 3466/ 3200/ 3066/ 3000/ 2933/ 2800/ 2667 MHz (by A-XMP OC MODE)*
  </li>
  <li class="item">
      * A-series/ Athlon processors support up to 2400 MHz. And the supporting frequency of memory varies with installed processor.
  </li>
</ul>'
),
('GIGABYTE Z370 AORUS GAMING 1151 Z370','189.99','assets/13-145-043-V06.jpg','3.7',
'<ul class="browser-default">           
  <li class="item">
      Intel Z370
  </li>
  <li class="item">
      Only Support for 8th Generation Intel Core i7/i5/i3 processors in the LGA1151 package
  </li>
  <li class="item">
      * Not backward compatible with older generation of LGA 1151 CPUs
  </li>
  <li class="item">
      DDR4 4000(O.C.)/ 3866(O.C.)/ 3800(O.C.)
  </li>
</ul>'),
('G.SKILL TridentZ RGB Series 16GB (2x8GB)','204.99','assets/20-232-476-S01.jpg','4.3',
'<ul class="browser-default">     
  <li class="item">
      DDR4 3200 (PC4 25600)
  </li>
  <li class="item">
      Timing 16-18-18-38
  </li>
  <li class="item">
      CAS Latency 16
  </li>
  <li class="item">
      Voltage 1.35V
  </li>
</ul>'),
('G.SKILL Ripjaws V Series 16GB (2x8GB)','149.99','assets/20-231-888-01.jpg','4.2',
'<ul class="browser-default">         
  <li class="item">
      DDR4 2400 (PC4 19200)
  </li>
  <li class="item">
      Timing 15-15-15-35
  </li>
  <li class="item">
      CAS Latency 15
  </li>
  <li class="item">
      Voltage 1.2V
  </li>
</ul>'),
('GIGABYTE Z370 AORUS GAMING 1151 Z370','189.99','assets/13-145-043-V06.jpg','3.7',''),
('GIGABYTE Z370 AORUS GAMING 1151 Z370','189.99','assets/13-145-043-V06.jpg','3.7',''),
('GIGABYTE Z370 AORUS GAMING 1151 Z370','189.99','assets/13-145-043-V06.jpg','3.7','');

INSERT INTO Customers
(First_Name, Username, Password, Email, IsAdmin)
VALUES
('Admin','admin','$2y$10$Z/FWH7GWpfLmjqPjbOmO1.5Iim81SenDoV9AJeiS.mqdJjnJh4CIi','web@serverintl.net','1');
