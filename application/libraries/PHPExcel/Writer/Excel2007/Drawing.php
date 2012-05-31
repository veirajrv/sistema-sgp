<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2010 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    Writer_Excel2007
 * @copyright  Copyright (c) 2006 - 2010 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.3c, 2010-06-01
 */


/**
 * Writer_Excel2007_Drawing
 *
 * @category   PHPExcel
 * @package    Writer_Excel2007
 * @copyright  Copyright (c) 2006 - 2010 PHPExcel (http://www.codeplex.com/PHPExcel)
 */
class Writer_Excel2007_Drawing extends Writer_Excel2007_WriterPart
{
	/**
	 * Write drawings to XML format
	 *
	 * @param 	Worksheet				$pWorksheet
	 * @return 	string 								XML Output
	 * @throws 	Exception
	 */
	public function writeDrawings(Worksheet $pWorksheet = null)
	{
		// Create XML writer
		$objWriter = null;
		if ($this->getParentWriter()->getUseDiskCaching()) {
			$objWriter = new Shared_XMLWriter(Shared_XMLWriter::STORAGE_DISK, $this->getParentWriter()->getDiskCachingDirectory());
		} else {
			$objWriter = new Shared_XMLWriter(Shared_XMLWriter::STORAGE_MEMORY);
		}

		// XML header
		$objWriter->startDocument('1.0','UTF-8','yes');

		// xdr:wsDr
		$objWriter->startElement('xdr:wsDr');
		$objWriter->writeAttribute('xmlns:xdr', 'http://schemas.openxmlformats.org/drawingml/2006/spreadsheetDrawing');
		$objWriter->writeAttribute('xmlns:a', 'http://schemas.openxmlformats.org/drawingml/2006/main');

			// Loop through images and write drawings
			$i = 1;
			$iterator = $pWorksheet->getDrawingCollection()->getIterator();
			while ($iterator->valid()) {
				$this->_writeDrawing($objWriter, $iterator->current(), $i);

				$iterator->next();
				++$i;
			}

		$objWriter->endElement();

		// Return
		return $objWriter->getData();
	}

	/**
	 * Write drawings to XML format
	 *
	 * @param 	Shared_XMLWriter			$objWriter 		XML Writer
	 * @param 	Worksheet_BaseDrawing		$pDrawing
	 * @param 	int									$pRelationId
	 * @throws 	Exception
	 */
	public function _writeDrawing(Shared_XMLWriter $objWriter = null, Worksheet_BaseDrawing $pDrawing = null, $pRelationId = -1)
	{
		if ($pRelationId >= 0) {
			// xdr:oneCellAnchor
			$objWriter->startElement('xdr:oneCellAnchor');
				// Image location
				$aCoordinates 		= Cell::coordinateFromString($pDrawing->getCoordinates());
				$aCoordinates[0] 	= Cell::columnIndexFromString($aCoordinates[0]);

				// xdr:from
				$objWriter->startElement('xdr:from');
					$objWriter->writeElement('xdr:col', $aCoordinates[0] - 1);
					$objWriter->writeElement('xdr:colOff', Shared_Drawing::pixelsToEMU($pDrawing->getOffsetX()));
					$objWriter->writeElement('xdr:row', $aCoordinates[1] - 1);
					$objWriter->writeElement('xdr:rowOff', Shared_Drawing::pixelsToEMU($pDrawing->getOffsetY()));
				$objWriter->endElement();

				// xdr:ext
				$objWriter->startElement('xdr:ext');
					$objWriter->writeAttribute('cx', Shared_Drawing::pixelsToEMU($pDrawing->getWidth()));
					$objWriter->writeAttribute('cy', Shared_Drawing::pixelsToEMU($pDrawing->getHeight()));
				$objWriter->endElement();

				// xdr:pic
				$objWriter->startElement('xdr:pic');

					// xdr:nvPicPr
					$objWriter->startElement('xdr:nvPicPr');

						// xdr:cNvPr
						$objWriter->startElement('xdr:cNvPr');
						$objWriter->writeAttribute('id', $pRelationId);
						$objWriter->writeAttribute('name', $pDrawing->getName());
						$objWriter->writeAttribute('descr', $pDrawing->getDescription());
						$objWriter->endElement();

						// xdr:cNvPicPr
						$objWriter->startElement('xdr:cNvPicPr');

							// a:picLocks
							$objWriter->startElement('a:picLocks');
							$objWriter->writeAttribute('noChangeAspect', '1');
							$objWriter->endElement();

						$objWriter->endElement();

					$objWriter->endElement();

					// xdr:blipFill
					$objWriter->startElement('xdr:blipFill');

						// a:blip
						$objWriter->startElement('a:blip');
						$objWriter->writeAttribute('xmlns:r', 'http://schemas.openxmlformats.org/officeDocument/2006/relationships');
						$objWriter->writeAttribute('r:embed', 'rId' . $pRelationId);
						$objWriter->endElement();

						// a:stretch
						$objWriter->startElement('a:stretch');
							$objWriter->writeElement('a:fillRect', null);
						$objWriter->endElement();

					$objWriter->endElement();

					// xdr:spPr
					$objWriter->startElement('xdr:spPr');

						// a:xfrm
						$objWriter->startElement('a:xfrm');
						$objWriter->writeAttribute('rot', Shared_Drawing::degreesToAngle($pDrawing->getRotation()));
						$objWriter->endElement();

						// a:prstGeom
						$objWriter->startElement('a:prstGeom');
						$objWriter->writeAttribute('prst', 'rect');

							// a:avLst
							$objWriter->writeElement('a:avLst', null);

						$objWriter->endElement();

//						// a:solidFill
//						$objWriter->startElement('a:solidFill');

//							// a:srgbClr
//							$objWriter->startElement('a:srgbClr');
//							$objWriter->writeAttribute('val', 'FFFFFF');

///* SHADE
//								// a:shade
//								$objWriter->startElement('a:shade');
//								$objWriter->writeAttribute('val', '85000');
//								$objWriter->endElement();
//*/

//							$objWriter->endElement();

//						$objWriter->endElement();
/*
						// a:ln
						$objWriter->startElement('a:ln');
						$objWriter->writeAttribute('w', '88900');
						$objWriter->writeAttribute('cap', 'sq');

							// a:solidFill
							$objWriter->startElement('a:solidFill');

								// a:srgbClr
								$objWriter->startElement('a:srgbClr');
								$objWriter->writeAttribute('val', 'FFFFFF');
								$objWriter->endElement();

							$objWriter->endElement();

							// a:miter
							$objWriter->startElement('a:miter');
							$objWriter->writeAttribute('lim', '800000');
							$objWriter->endElement();

						$objWriter->endElement();
*/

						if ($pDrawing->getShadow()->getVisible()) {
							// a:effectLst
							$objWriter->startElement('a:effectLst');

								// a:outerShdw
								$objWriter->startElement('a:outerShdw');
								$objWriter->writeAttribute('blurRad', 		Shared_Drawing::pixelsToEMU($pDrawing->getShadow()->getBlurRadius()));
								$objWriter->writeAttribute('dist',			Shared_Drawing::pixelsToEMU($pDrawing->getShadow()->getDistance()));
								$objWriter->writeAttribute('dir',			Shared_Drawing::degreesToAngle($pDrawing->getShadow()->getDirection()));
								$objWriter->writeAttribute('algn',			$pDrawing->getShadow()->getAlignment());
								$objWriter->writeAttribute('rotWithShape', 	'0');

									// a:srgbClr
									$objWriter->startElement('a:srgbClr');
									$objWriter->writeAttribute('val',		$pDrawing->getShadow()->getColor()->getRGB());

										// a:alpha
										$objWriter->startElement('a:alpha');
										$objWriter->writeAttribute('val', 	$pDrawing->getShadow()->getAlpha() * 1000);
										$objWriter->endElement();

									$objWriter->endElement();

								$objWriter->endElement();

							$objWriter->endElement();
						}
/*

						// a:scene3d
						$objWriter->startElement('a:scene3d');

							// a:camera
							$objWriter->startElement('a:camera');
							$objWriter->writeAttribute('prst', 'orthographicFront');
							$objWriter->endElement();

							// a:lightRig
							$objWriter->startElement('a:lightRig');
							$objWriter->writeAttribute('rig', 'twoPt');
							$objWriter->writeAttribute('dir', 't');

								// a:rot
								$objWriter->startElement('a:rot');
								$objWriter->writeAttribute('lat', '0');
								$objWriter->writeAttribute('lon', '0');
								$objWriter->writeAttribute('rev', '0');
								$objWriter->endElement();

							$objWriter->endElement();

						$objWriter->endElement();
*/
/*
						// a:sp3d
						$objWriter->startElement('a:sp3d');

							// a:bevelT
							$objWriter->startElement('a:bevelT');
							$objWriter->writeAttribute('w', '25400');
							$objWriter->writeAttribute('h', '19050');
							$objWriter->endElement();

							// a:contourClr
							$objWriter->startElement('a:contourClr');

								// a:srgbClr
								$objWriter->startElement('a:srgbClr');
								$objWriter->writeAttribute('val', 'FFFFFF');
								$objWriter->endElement();

							$objWriter->endElement();

						$objWriter->endElement();
*/
					$objWriter->endElement();

				$objWriter->endElement();

				// xdr:clientData
				$objWriter->writeElement('xdr:clientData', null);

			$objWriter->endElement();
		} else {
			throw new Exception("Invalid parameters passed.");
		}
	}

	/**
	 * Write VML header/footer images to XML format
	 *
	 * @param 	Worksheet				$pWorksheet
	 * @return 	string 								XML Output
	 * @throws 	Exception
	 */
	public function writeVMLHeaderFooterImages(Worksheet $pWorksheet = null)
	{
		// Create XML writer
		$objWriter = null;
		if ($this->getParentWriter()->getUseDiskCaching()) {
			$objWriter = new Shared_XMLWriter(Shared_XMLWriter::STORAGE_DISK, $this->getParentWriter()->getDiskCachingDirectory());
		} else {
			$objWriter = new Shared_XMLWriter(Shared_XMLWriter::STORAGE_MEMORY);
		}

		// XML header
		$objWriter->startDocument('1.0','UTF-8','yes');

  		// Header/footer images
  		$images = $pWorksheet->getHeaderFooter()->getImages();

		// xml
		$objWriter->startElement('xml');
		$objWriter->writeAttribute('xmlns:v', 'urn:schemas-microsoft-com:vml');
		$objWriter->writeAttribute('xmlns:o', 'urn:schemas-microsoft-com:office:office');
		$objWriter->writeAttribute('xmlns:x', 'urn:schemas-microsoft-com:office:excel');

			// o:shapelayout
			$objWriter->startElement('o:shapelayout');
			$objWriter->writeAttribute('v:ext', 		'edit');

				// o:idmap
				$objWriter->startElement('o:idmap');
				$objWriter->writeAttribute('v:ext', 	'edit');
				$objWriter->writeAttribute('data', 		'1');
				$objWriter->endElement();

			$objWriter->endElement();

			// v:shapetype
			$objWriter->startElement('v:shapetype');
			$objWriter->writeAttribute('id', 					'_x0000_t75');
			$objWriter->writeAttribute('coordsize', 			'21600,21600');
			$objWriter->writeAttribute('o:spt', 				'75');
			$objWriter->writeAttribute('o:preferrelative', 		't');
			$objWriter->writeAttribute('path', 					'm@4@5l@4@11@9@11@9@5xe');
			$objWriter->writeAttribute('filled',		 		'f');
			$objWriter->writeAttribute('stroked',		 		'f');

				// v:stroke
				$objWriter->startElement('v:stroke');
				$objWriter->writeAttribute('joinstyle', 		'miter');
				$objWriter->endElement();

				// v:formulas
				$objWriter->startElement('v:formulas');

					// v:f
					$objWriter->startElement('v:f');
					$objWriter->writeAttribute('eqn', 		'if lineDrawn pixelLineWidth 0');
					$objWriter->endElement();

					// v:f
					$objWriter->startElement('v:f');
					$objWriter->writeAttribute('eqn', 		'sum @0 1 0');
					$objWriter->endElement();

					// v:f
					$objWriter->startElement('v:f');
					$objWriter->writeAttribute('eqn', 		'sum 0 0 @1');
					$objWriter->endElement();

					// v:f
					$objWriter->startElement('v:f');
					$objWriter->writeAttribute('eqn', 		'prod @2 1 2');
					$objWriter->endElement();

					// v:f
					$objWriter->startElement('v:f');
					$objWriter->writeAttribute('eqn', 		'prod @3 21600 pixelWidth');
					$objWriter->endElement();

					// v:f
					$objWriter->startElement('v:f');
					$objWriter->writeAttribute('eqn', 		'prod @3 21600 pixelHeight');
					$objWriter->endElement();

					// v:f
					$objWriter->startElement('v:f');
					$objWriter->writeAttribute('eqn', 		'sum @0 0 1');
					$objWriter->endElement();

					// v:f
					$objWriter->startElement('v:f');
					$objWriter->writeAttribute('eqn', 		'prod @6 1 2');
					$objWriter->endElement();

					// v:f
					$objWriter->startElement('v:f');
					$objWriter->writeAttribute('eqn', 		'prod @7 21600 pixelWidth');
					$objWriter->endElement();

					// v:f
					$objWriter->startElement('v:f');
					$objWriter->writeAttribute('eqn', 		'sum @8 21600 0');
					$objWriter->endElement();

					// v:f
					$objWriter->startElement('v:f');
					$objWriter->writeAttribute('eqn', 		'prod @7 21600 pixelHeight');
					$objWriter->endElement();

					// v:f
					$objWriter->startElement('v:f');
					$objWriter->writeAttribute('eqn', 		'sum @10 21600 0');
					$objWriter->endElement();

				$objWriter->endElement();

				// v:path
				$objWriter->startElement('v:path');
				$objWriter->writeAttribute('o:extrusionok', 	'f');
				$objWriter->writeAttribute('gradientshapeok', 	't');
				$objWriter->writeAttribute('o:connecttype', 	'rect');
				$objWriter->endElement();

				// o:lock
				$objWriter->startElement('o:lock');
				$objWriter->writeAttribute('v:ext', 			'edit');
				$objWriter->writeAttribute('aspectratio', 		't');
				$objWriter->endElement();

			$objWriter->endElement();

			// Loop through images
			foreach ($images as $key => $value) {
				$this->_writeVMLHeaderFooterImage($objWriter, $key, $value);
			}

		$objWriter->endElement();

		// Return
		return $objWriter->getData();
	}

	/**
	 * Write VML comment to XML format
	 *
	 * @param 	Shared_XMLWriter		$objWriter 			XML Writer
	 * @param	string							$pReference			Reference
	 * @param 	Worksheet_HeaderFooterDrawing	$pImage		Image
	 * @throws 	Exception
	 */
	public function _writeVMLHeaderFooterImage(Shared_XMLWriter $objWriter = null, $pReference = '', Worksheet_HeaderFooterDrawing $pImage = null)
	{
		// Calculate object id
		preg_match('{(\d+)}', md5($pReference), $m);
		$id = 1500 + (substr($m[1], 0, 2) * 1);

		// Calculate offset
		$width = $pImage->getWidth();
		$height = $pImage->getHeight();
		$marginLeft = $pImage->getOffsetX();
		$marginTop = $pImage->getOffsetY();

		// v:shape
		$objWriter->startElement('v:shape');
		$objWriter->writeAttribute('id', 			$pReference);
		$objWriter->writeAttribute('o:spid', 		'_x0000_s' . $id);
		$objWriter->writeAttribute('type', 			'#_x0000_t75');
		$objWriter->writeAttribute('style', 		"position:absolute;margin-left:{$marginLeft}px;margin-top:{$marginTop}px;width:{$width}px;height:{$height}px;z-index:1");

			// v:imagedata
			$objWriter->startElement('v:imagedata');
			$objWriter->writeAttribute('o:relid', 		'rId' . $pReference);
			$objWriter->writeAttribute('o:title', 		$pImage->getName());
			$objWriter->endElement();

			// o:lock
			$objWriter->startElement('o:lock');
			$objWriter->writeAttribute('v:ext', 		'edit');
			$objWriter->writeAttribute('rotation', 		't');
			$objWriter->endElement();

		$objWriter->endElement();
	}


	/**
	 * Get an array of all drawings
	 *
	 * @param 	PHPExcel							$pPHPExcel
	 * @return 	Worksheet_Drawing[]		All drawings in PHPExcel
	 * @throws 	Exception
	 */
	public function allDrawings(PHPExcel $pPHPExcel = null)
	{
		// Get an array of all drawings
		$aDrawings	= array();

		// Loop through PHPExcel
		$sheetCount = $pPHPExcel->getSheetCount();
		for ($i = 0; $i < $sheetCount; ++$i) {
			// Loop through images and add to array
			$iterator = $pPHPExcel->getSheet($i)->getDrawingCollection()->getIterator();
			while ($iterator->valid()) {
				$aDrawings[] = $iterator->current();

  				$iterator->next();
			}
		}

		return $aDrawings;
	}
}
