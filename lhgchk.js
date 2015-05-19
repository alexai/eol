/*
 *@Generator -> LiHuiGang - Email:lhg133@126.com - QQ:463214570
 *@Copyright (c) 2009 LiHuiGang Compostion - Blog:http://www.cnblogs.com/lhgstudio
 */

String.prototype.trim = function(){ return this.replace( /(^\s*)|(\s*$)/g, ''); };
var $ = function(id){ return 'string' == typeof(id) ? document.getElementById(id) : id; };

var toback = function( n, t )
{
	var p = t.parentNode || t[t.length -1].parentNode;;
	if( p.lastChild == t ) p.appendChild(n);
	else p.insertBefore( n, t.nextSibling );
}

var lhgchk = (function()
{
	var ver = '1.0', ajaxerr = null, mode, require = /.+/,
	email = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
	english = /^[A-Za-z]+$/,
	chinese = /^[\u0391-\uFFE5]+$/,
	url = /^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/,
	ip = /^(0|[1-9]\d?|[0-1]\d{2}|2[0-4]\d|25[0-5]).(0|[1-9]\d?|[0-1]\d{2}|2[0-4]\d|25[0-5]).(0|[1-9]\d?|[0-1]\d{2}|2[0-4]\d|25[0-5]).(0|[1-9]\d?|[0-1]\d{2}|2[0-4]\d|25[0-5])$/,
	zip = /^[1-9]\d{5}$/,
	qq = /^[1-9]\d{4,10}$/,
	alpha = /^[0-9a-zA-Z\_]+$/,
	cell = /^1[3,5][0-9]\d{8}$/,
	phone = /^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/;
	
	var chklimit = function( val, min, max )
	{
		min = min ? min : Number.MIN_VALUE;
		max = max ? max : Number.MAX_VALUE;
		return ( val >= min && val <= max );
	};
	
	var chkrang = function( val, min, max )
	{
		return chklimit( val, min, max );
	};
	
	var gethttp = function()
	{
		try{ return new XMLHttpRequest(); }catch(e){}
		try{ return new ActiveXObject('Msxml2.XMLHTTP'); }catch(e){}
		try{ return new ActiveXObject('Microsoft.XMLHTTP'); }catch(e){}
	
		return null;
	};
	
	var chkajax = function( r, val )
	{
		if(r.mid){ $(r.mid).innerHTML = 'Ajax验证中...'; $(r.mid).className = 'chkaj'; }
		else
		{
		    if($(r.name+'err')){ $(r.name+'err').innerHTML = 'Ajax验证中...'; $(r.name+'err').className = 'chkaj'; }
			else
			{
			    var _span = document.createElement('span'); _span.id = r.name + 'err';
				_span.className = 'chkaj'; _span.innerHTML = 'Ajax验证中...'; toback( _span, $(r.name) );
			}
		}
		
		var oh = gethttp(), url = r.url + val;
		oh.open( 'GET', url, false );
		oh.send(null);
		
		var bool = false;
		if( (oh.readyState == 4) && (oh.status == 200) )
		{
			var retxt = oh.responseText.split('|');
			if( retxt[0] == 1 ) bool = true;
			else{ ajaxerr = retxt[1] || null; bool = false; }
		}
		delete(oh); return bool;
	};
	
	var chkmatch = function( val, el )
	{
	    var to = $(el).value;
		return ( val == to );
	};
	
	var chkdate = function(val)
	{
	    var r = val.replace(/(^\s*)|(\s*$)/g, '').match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/);
		if(!r) return false; var d = new Date( r[1], r[3]-1, r[4] );
		return ( d.getFullYear()==r[1]&&(d.getMonth()+1)==r[3]&&d.getDate()==r[4] );
	};
	
	var chkfilter = function( val, r )
	{
	    return new RegExp( '^.+\.(?=EXT)(EXT)$'.replace(/EXT/g, r.split(/\s*,\s*/).join('|')), 'gi' ).test(val);
	};
	
	var chkgroup = function( e, r )
	{
	    var min = r.min || 1, max = r.max || e.length, o, cn = 0;
		for( var i = 0; o = e[i]; i++ )
		{
		    if( o.checked != undefined ){ if(o.checked) cn++; }
			else
			{
			    var nosel = r.noselected || '';
				if( o.selected && nosel == o.value ) return false;
				if(o.selected) cn++;
			}
		}
		return ( cn >= min && cn <= max );
	};
	
	var showerr = function( x, m, e )
	{
	    if( !x && !m ) return;
		if( !x && m ) x = $(m).innerHTML;
		
		if( mode == 0 )
		{
		    if(m){ $(m).innerHTML = x; $(m).className = 'chker'; }
			else
			{
			    if($(e.name+'err')){ $(e.name+'err').innerHTML = x; $(e.name+'err').className = 'chker'; }
				else
				{
				    var _span = document.createElement('span'); _span.id = e.name + 'err';
				    _span.className = 'chker'; _span.innerHTML = x; toback( _span, e );
				}
			}
		}
		else
		    alert(x);
		
		if( e.type == 'text' ) e.style.border = '1px solid #f00';
	}	
	
	return {
		regform : function(o)
		{
		    var frm = document.forms[o.form]; mode = o.mode || 0;
			for( var i = 0; i < this.rules.length; i++ )
			{
			    var r = this.rules[i];
				if( r.required ) frm[r.name].onblur = lhgchk.blurchk;
			}
			
			frm.onsubmit = function()
			{
				for( var i = 0; i < lhgchk.rules.length; i++ )
				{
				    var r = lhgchk.rules[i]; if( typeof(r) == 'undefined' ) continue;
					var el = frm[r.name], b = lhgchk.formchk( el, r );
					if(!b){ if( el.type == 'text' || el.type == 'password' ) el.focus(); return false; }
				}
				return true;
			};
		},
		
		blurchk : function()
		{
			for( var i = 0; i < lhgchk.rules.length; i++ )
			{
			    var r = lhgchk.rules[i];
				if( r.name == this.name ) break;
			}
			lhgchk.formchk( this, r );
		},
		
		formchk : function( e, r )
		{
			var bool = true, errinfo = null;
			if( e.value != undefined ) var v = e.value.trim();
			
			if( r.required && e.length == undefined && !require.test(v) )
			{
				errinfo = '必填内容，不能为空'; bool = false;
			}
			else if( !r.required && (e.length != undefined || e.value == '') )
			    return true;
			else
			{
				var types = r.type.split('|'), warns = r.warn.split('|');
				for( var i = 0; i < types.length; i++ )
				{
					switch( types[i] )
					{
						case 'email' : bool = email.test(v); break;
						case 'qq'    : bool = qq.test(v); break;
						case 'limit' : bool = chklimit( v.length, r.min, r.max ); break;
						case 'rang'  : bool = chkrang( v, r.min, r.max ); break;
						case 'eng'   : bool = english.test(v); break;
						case 'ajax'  : bool = chkajax( r, v ); break;
						case 'match' : bool = chkmatch( e.value, r.to ); break;
						case 'ip'    : bool = ip.test(v); break;
						case 'date'  : bool = chkdate(v); break;
						case 'qq'    : bool = qq.test(v); break;
						case 'phone' : bool = phone.test(v); break;
						case 'cell'  : bool = cell.test(v); break;
						case 'filter': bool = chkfilter( v, r.accept ); break;
						case 'group' : bool = chkgroup( e, r ); break;
					}
					if(!bool){ if(warns[i]) errinfo = warns[i]; break; }
				}
			}
			
			if(!bool)
			{
			    if(ajaxerr) errinfo = ajaxerr; showerr( errinfo, r.mid, e ); ajaxerr = null;
			}
			else
			{
			    if($(r.mid)){ $(r.mid).innerHTML = '验证通过'; $(r.mid).className = 'chkok'; }
				else if($(e.name+'err')){ $(e.name+'err').innerHTML = '验证通过'; $(e.name+'err').className = 'chkok'; }
				if( e.type == 'text' || e.type == 'password' ) e.style.border = '1px solid #999';
			}
			return bool;
		}
	};
})();