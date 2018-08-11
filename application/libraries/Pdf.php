<?php
require_once APPPATH."/third_party/fpdf/fpdf.php";
class PDF extends FPDF {

  public $tablewidths;
  public $footerset;

  function _beginpage($orientation, $size, $rotation) {
    $this->page++;
    if(!isset($this->pages[$this->page])) // solves the problem of overwriting a page if it already exists
    $this->pages[$this->page] = '';
    $this->state = 2;
    $this->x = $this->lMargin;
    $this->y = $this->tMargin;
    $this->FontFamily = '';
    // Check page size and orientation
    if($orientation=='')
      $orientation = $this->DefOrientation;
    else
      $orientation = strtoupper($orientation[0]);
    if($size=='')
      $size = $this->DefPageSize;
    else
      $size = $this->_getpagesize($size);
    if($orientation!=$this->CurOrientation || $size[0]!=$this->CurPageSize[0] || $size[1]!=$this->CurPageSize[1])
    {
        // New size or orientation
      if($orientation=='P')
      {
        $this->w = $size[0];
        $this->h = $size[1];
      }
      else
      {
        $this->w = $size[1];
        $this->h = $size[0];
      }
      $this->wPt = $this->w*$this->k;
      $this->hPt = $this->h*$this->k;
      $this->PageBreakTrigger = $this->h-$this->bMargin;
      $this->CurOrientation = $orientation;
      $this->CurPageSize = $size;
    }
    if($orientation!=$this->DefOrientation || $size[0]!=$this->DefPageSize[0] || $size[1]!=$this->DefPageSize[1])
      $this->PageInfo[$this->page]['size'] = array($this->wPt, $this->hPt);
    if($rotation!=0)
    {
      if($rotation%90!=0)
        $this->Error('Incorrect rotation value: '.$rotation);
      $this->CurRotation = $rotation;
      $this->PageInfo[$this->page]['rotation'] = $rotation;
    }
  }

  public function Header(){
    $this->Image(base_url().'assets/img/logo_cosisei.png',175,5,30);
    $this->SetFont('Arial','B',16);
    $this->Cell(30);
    $this->Cell(120,10,'Simposio Internacional de Sistemas e Informática',0,0,'C');
    $this->Ln('5');
    $this->Ln(10);
  }

  function Footer() {
    // Check if Footer for this page already exists (do the same for Header())
    if(!isset($this->footerset[$this->page])) {
      $this->SetY(-15);
        // Page number
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        // set footerset
      $this->footerset[$this->page] = true;
    }
  }

  function morepagestable($datas, $lineheight=8, $align="C", $strip=false) {
    // some things to set and 'remember'
    $l = $this->lMargin;
    $startheight = $h = $this->GetY();
    $startpage = $currpage = $maxpage = $this->page;

    // calculate the whole width
    $fullwidth = 0;
    foreach($this->tablewidths AS $width) {
      $fullwidth += $width;
    }
    $k=1;
    // Now let's start to write the table
    foreach($datas AS $row => $data) {
      $this->page = $currpage;
        // write the horizontal borders
      $this->Line($l,$h,$fullwidth+$l,$h);
        // write the content and remember the height of the highest col
      $hue=array_values($data);
      foreach($hue AS $col => $txt) {
        $this->page = $currpage;
        $this->SetXY($l,$h);
        if($strip){
          $this->SetFillColor(213 , 213 , 213);
          $this->MultiCell($this->tablewidths[$col],$lineheight,$txt,"T",$align,$k%2==0);
        }else{
          $this->MultiCell($this->tablewidths[$col],$lineheight,$txt,0,$align);
        }
        $l += $this->tablewidths[$col];

        if(!isset($tmpheight[$row.'-'.$this->page]))
          $tmpheight[$row.'-'.$this->page] = 0;
        if($tmpheight[$row.'-'.$this->page] < $this->GetY()) {
          $tmpheight[$row.'-'.$this->page] = $this->GetY();
        }
        if($this->page > $maxpage)
          $maxpage = $this->page;
      }

        // get the height we were in the last used page
      $h = $tmpheight[$row.'-'.$maxpage];
        // set the "pointer" to the left margin
      $l = $this->lMargin;
        // set the $currpage to the last page
      $currpage = $maxpage;
      $k++;
    }
    // draw the borders
    // we start adding a horizontal line on the last page
    $this->page = $maxpage;
    $this->Line($l,$h,$fullwidth+$l,$h);
    // now we start at the top of the document and walk down
    for($i = $startpage; $i <= $maxpage; $i++) {
      $this->page = $i;
      $l = $this->lMargin;
      $t  = ($i == $startpage) ? $startheight : $this->tMargin;
      $lh = ($i == $maxpage)   ? $h : $this->h-$this->bMargin;
      $this->Line($l,$t,$l,$lh);
      foreach($this->tablewidths AS $width) {
        $l += $width;
        $this->Line($l,$t,$l,$lh);
      }
    }
    // set it to the last page, if not it'll cause some problems
    $this->page = $maxpage;
  }

  function tablaAsistentes($datas, $lineheight=8, $align="C", $strip=false) {
    // some things to set and 'remember'
    $l = $this->lMargin;
    $startheight = $h = $this->GetY();
    $startpage = $currpage = $maxpage = $this->page;

    // calculate the whole width
    $fullwidth = 0;
    foreach($this->tablewidths AS $width) {
      $fullwidth += $width;
    }

    // Now let's start to write the table
    $k=1;
    foreach($datas AS $row => $data) {
      $this->page = $currpage;
        // write the horizontal borders
      $this->Line($l,$h,$fullwidth+$l,$h);
        // write the content and remember the height of the highest col
      $hue=array_values($data);
      foreach($hue AS $col => $txt) {
        $this->page = $currpage;
        $this->SetXY($l,$h);
        if($strip){
          $this->SetFillColor(213 , 213 , 213);
          if($col==2){
            $this->MultiCell($this->tablewidths[$col],$lineheight,$txt,"T","L",$k%2==0);
          }else{
            $this->MultiCell($this->tablewidths[$col],$lineheight,$txt,"T",$align,$k%2==0);
          }
        }else{
          if($col==2){
            $this->MultiCell($this->tablewidths[$col],$lineheight,$txt,0,"L");
          }else{
            $this->MultiCell($this->tablewidths[$col],$lineheight,$txt,0,$align);
          }
        }
        $l += $this->tablewidths[$col];

        if(!isset($tmpheight[$row.'-'.$this->page]))
          $tmpheight[$row.'-'.$this->page] = 0;
        if($tmpheight[$row.'-'.$this->page] < $this->GetY()) {
          $tmpheight[$row.'-'.$this->page] = $this->GetY();
        }
        if($this->page > $maxpage)
          $maxpage = $this->page;
      }

        // get the height we were in the last used page
      $h = $tmpheight[$row.'-'.$maxpage];
        // set the "pointer" to the left margin
      $l = $this->lMargin;
        // set the $currpage to the last page
      $currpage = $maxpage;
      $k++;
    }
    // draw the borders
    // we start adding a horizontal line on the last page
    $this->page = $maxpage;
    $this->Line($l,$h,$fullwidth+$l,$h);
    // now we start at the top of the document and walk down
    for($i = $startpage; $i <= $maxpage; $i++) {
      $this->page = $i;
      $l = $this->lMargin;
      $t  = ($i == $startpage) ? $startheight : $this->tMargin;
      $lh = ($i == $maxpage)   ? $h : $this->h-$this->bMargin;
      $this->Line($l,$t,$l,$lh);
      foreach($this->tablewidths AS $width) {
        $l += $width;
        $this->Line($l,$t,$l,$lh);
      }
    }
    // set it to the last page, if not it'll cause some problems
    $this->page = $maxpage;
  }




  function Recibo($orientation='', $size='', $rotation=0)
  {
  // Start a new page
    if($this->state==3)
      $this->Error('The document is closed');
    $family = $this->FontFamily;
    $style = $this->FontStyle.($this->underline ? 'U' : '');
    $fontsize = $this->FontSizePt;
    $lw = $this->LineWidth;
    $dc = $this->DrawColor;
    $fc = $this->FillColor;
    $tc = $this->TextColor;
    $cf = $this->ColorFlag;
    if($this->page>0)
    {
    // Page footer
      $this->InFooter = true;
      $this->Footer();
      $this->InFooter = false;
    // Close page
      $this->_endpage();
    }
  // Start new page
    $this->_beginpage($orientation,$size,$rotation);
  // Set line cap style to square
    $this->_out('2 J');
  // Set line width
    $this->LineWidth = $lw;
    $this->_out(sprintf('%.2F w',$lw*$this->k));
  // Set font
    if($family)
      $this->SetFont($family,$style,$fontsize);
  // Set colors
    $this->DrawColor = $dc;
    if($dc!='0 G')
      $this->_out($dc);
    $this->FillColor = $fc;
    if($fc!='0 g')
      $this->_out($fc);
    $this->TextColor = $tc;
    $this->ColorFlag = $cf;
  // Page header
    $this->InHeader = true;
    $this->HeaderRecibo();
    $this->InHeader = false;
  // Restore line width
    if($this->LineWidth!=$lw)
    {
      $this->LineWidth = $lw;
      $this->_out(sprintf('%.2F w',$lw*$this->k));
    }
  // Restore font
    if($family)
      $this->SetFont($family,$style,$fontsize);
  // Restore colors
    if($this->DrawColor!=$dc)
    {
      $this->DrawColor = $dc;
      $this->_out($dc);
    }
    if($this->FillColor!=$fc)
    {
      $this->FillColor = $fc;
      $this->_out($fc);
    }
    $this->TextColor = $tc;
    $this->ColorFlag = $cf;
  }


  public function HeaderRecibo(){
    $this->Image(base_url().'assets/img/logo_cosisei.png',175,5,30);
    $this->SetFont('Arial','B',18);
    $this->Cell(30);
    $this->Cell(120,10,'Comprobante de pago',0,0,'C');
    $this->Ln('5');
    $this->Ln(10);
  }




function tablaRecibo($datas, $lineheight=8) {
    // some things to set and 'remember'
    $l = $this->lMargin;
    $startheight = $h = $this->GetY();
    $startpage = $currpage = $maxpage = $this->page;

    // calculate the whole width
    $fullwidth = 0;
    foreach($this->tablewidths AS $width) {
        $fullwidth += $width;
    }

    // Now let's start to write the table
    foreach($datas AS $row => $data) {
        $this->page = $currpage;
        // write the horizontal borders
        $this->Line($l,$h,$fullwidth+$l,$h);
        // write the content and remember the height of the highest col
        foreach($data AS $col => $txt) {
            $this->page = $currpage;
            $this->SetXY($l,$h);
            $this->MultiCell($this->tablewidths[$col],$lineheight,$txt);
            $l += $this->tablewidths[$col];

            if(!isset($tmpheight[$row.'-'.$this->page]))
                $tmpheight[$row.'-'.$this->page] = 0;
            if($tmpheight[$row.'-'.$this->page] < $this->GetY()) {
                $tmpheight[$row.'-'.$this->page] = $this->GetY();
            }
            if($this->page > $maxpage)
                $maxpage = $this->page;
        }

        // get the height we were in the last used page
        $h = $tmpheight[$row.'-'.$maxpage];
        // set the "pointer" to the left margin
        $l = $this->lMargin;
        // set the $currpage to the last page
        $currpage = $maxpage;
    }
    // draw the borders
    // we start adding a horizontal line on the last page
    $this->page = $maxpage;
    $this->Line($l,$h,$fullwidth+$l,$h);
    // now we start at the top of the document and walk down
    for($i = $startpage; $i <= $maxpage; $i++) {
        $this->page = $i;
        $l = $this->lMargin;
        $t  = ($i == $startpage) ? $startheight : $this->tMargin;
        $lh = ($i == $maxpage)   ? $h : $this->h-$this->bMargin;
        $this->Line($l,$t,$l,$lh);
        foreach($this->tablewidths AS $width) {
            $l += $width;
            $this->Line($l,$t,$l,$lh);
        }
    }
    // set it to the last page, if not it'll cause some problems
    $this->page = $maxpage;
}

}
?>